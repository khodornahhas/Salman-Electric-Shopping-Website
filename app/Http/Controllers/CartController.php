<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\CartItem;


class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            $item = CartItem::where('user_id', Auth::id())->where('product_id', $productId)->first();

            if ($item) {
                $item->quantity += $quantity;
                $item->save();
            } 
            else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        } 
            else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } 
            else {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image, 
                    'quantity' => $quantity,
                ];
            }
            session()->put('cart', $cart);
        }

      return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }

    public function index()
    {
        if (Auth::check()) {
            $cartItems = CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();

        } 
        else {
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
                    'quantity' => $item['quantity'],
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
                } else {
                    $item->save();
                }
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $change;
                if ($cart[$productId]['quantity'] < 1) {
                    unset($cart[$productId]);
                }
            }
            session()->put('cart', $cart);
        }

        if ($user) {
            return response()->json([
                'success' => true,
                'quantity' => $item->quantity,
                'price' => number_format($item->product->price * $item->quantity, 2),
            ]);
        } else {
            $quantity = $cart[$productId]['quantity'] ?? 0;
            $price = number_format($cart[$productId]['price'] * $quantity, 2);

            return response()->json([
                'success' => true,
                'quantity' => $quantity,
                'price' => $price,
            ]);
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
        $cart = Auth::check() ? 
            CartItem::with('product')->where('user_id', Auth::id())->get() :
            collect(session('cart', []))->map(function ($item, $productId) {
                return (object) array_merge(['id' => $productId], $item);
            });

        $subtotal = $cart->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.checkout', compact('cart', 'subtotal'));
    }

}

