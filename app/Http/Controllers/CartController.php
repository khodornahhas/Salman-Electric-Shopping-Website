<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);
            $quantity = (int) $request->input('quantity') ?: 1;

            if (Auth::check()) {
                $item = CartItem::where('user_id', Auth::id())->where('product_id', $productId)->first();

                if ($item) {
                    $item->quantity += $quantity;
                    $item->save();
                } else {
                    CartItem::create([
                        'user_id' => Auth::id(),
                        'product_id' => $productId,
                        'quantity' => $quantity,
                    ]);
                }
            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += $quantity;
                } else {
                    $cart[$productId] = [
                        'product_id' => $productId,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => $product->image,
                        'quantity' => $quantity,
                    ];
                }
                session()->put('cart', $cart);
            }

            if ($request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Product added to cart!']);
            } else {
                return redirect()->back()->with('success', 'Product added to cart!');
            }
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ], 500);
            } else {
                return redirect()->back()->with('error', 'Failed to add product to cart: ' . $e->getMessage());
            }
        }
    }


    public function index()
    {
        if (Auth::check()) {
            $cartItems = CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $cart = session()->get('cart', []);
            $cartItems = [];
            foreach ($cart as $productId => $item) {
                $cartItems[] = (object)[
                    'product' => (object)[
                        'id' => $productId,
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                    ],
                    'quantity' => isset($item['quantity']) && $item['quantity'] > 0 ? $item['quantity'] : 1,
                ];
            }
        }
        return view('cart.index', compact('cartItems'));
    }


    public function update(Request $request, $productId)
    {
        $change = $request->input('change', 0);
        $user = Auth::user();

        if ($user) {
            $item = CartItem::where('user_id', $user->id)->where('product_id', $productId)->first();
            if ($item) {
                $item->quantity += $change;

                if ($item->quantity < 1) {
                    $item->delete();
                    return response()->json([
                        'success' => true,
                        'deleted' => true,
                    ]);
                } else {
                    $item->save();

                    return response()->json([
                        'success' => true,
                        'quantity' => $item->quantity,
                        'price' => number_format($item->product->price * $item->quantity, 2),
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Item not found',
            ], 404);

        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $change;

                if ($cart[$productId]['quantity'] < 1) {
                    unset($cart[$productId]);
                    session()->put('cart', $cart);

                    return response()->json([
                        'success' => true,
                        'deleted' => true,
                    ]);
                } else {
                    session()->put('cart', $cart);

                    return response()->json([
                        'success' => true,
                        'quantity' => $cart[$productId]['quantity'],
                        'price' => number_format($cart[$productId]['price'] * $cart[$productId]['quantity'], 2),
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart',
            ], 404);
        }
    }


    public function total()
    {
        if (Auth::check()) {
            $total = CartItem::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->sum(fn($item) => $item->product->price * $item->quantity);
        } else {
            $cart = session()->get('cart', []);
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        }

        return response()->json([
            'total' => number_format($total, 2)
        ]);
    }

    public function count()
    {
        if (Auth::check()) {
            $count = CartItem::where('user_id', Auth::id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            $count = collect($cart)->sum('quantity');
        }

        return response()->json(['count' => $count]);
    }


    public function remove($productId)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed!');
    }

    public function clear()
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->back()->with('success', 'Cart cleared!');
    }

    public function checkout()
    {
        $hasItems = Auth::check()
            ? CartItem::where('user_id', Auth::id())->exists()
            : !empty(session('cart', []));

        if (!$hasItems) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items before proceeding.');
        }

        $cart = Auth::check() 
            ? CartItem::with('product')->where('user_id', Auth::id())->get() 
            : collect(session('cart', []))->map(function ($item, $productId) {
                return (object) array_merge(['id' => $productId], $item);
            });

        $subtotal = $cart->sum(function ($item) {
            $price = $item->price ?? ($item->product->price ?? 0);
            return $price * $item->quantity;
        });

        return view('cart.checkout', compact('cart', 'subtotal'));
    }


    public function confirm(Request $request)
    {
        if (!$request->isMethod('post') || !$request->has('first_name')) {
            return redirect()->route('cart.checkout')->with('error', 'Please complete the checkout form first.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'notes' => 'nullable|string',
            'shipping' => 'required|in:5.00,4.00,0.00',
        ]);

        return view('cart.confirm', ['data' => $validated]);
    }


   public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'street' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'shipping' => 'required|in:5.00,4.00,0.00',
        ]);

        $cart = Auth::check()
            ? CartItem::with('product')->where('user_id', Auth::id())->get()
            : collect(session()->get('cart', []));

        if ($cart->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            if (Auth::check()) {
                $product = $item->product;
                if ($product) {
                    $subtotal += $product->price * $item->quantity;
                }
            } else {
                $product = Product::find($item['product_id']);
                if ($product) {
                    $subtotal += ($item['price'] ?? $product->price) * $item['quantity'];
                }
            }
        }

        $shipping = floatval($validated['shipping']);
        $total = $subtotal + $shipping;

        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'street' => $validated['street'],
            'apartment' => $validated['apartment'],
            'city' => $validated['city'],
            'notes' => $validated['notes'],
            'shipping' => $shipping,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            if (Auth::check()) {
                $product = $item->product;
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'price' => $product->price,
                    ]);
                }
            } else {
                $product = Product::find($item['product_id']);
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'] ?? $product->price,
                    ]);
                }
            }
        }

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect('/home')->with('success', 'Your order has been placed! We will contact you shortly.');
    }
    
}

