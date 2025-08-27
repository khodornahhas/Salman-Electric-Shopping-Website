<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RedeemedPromoCode;
use App\Mail\OrderNotificationMail;
use App\Mail\OrderConfirmationMail;
use App\Models\BlockedIp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{  
    public function add(Request $request, $productId){
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


    public function index(){
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


    public function update(Request $request, $productId){
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


    public function total(){
        $promoId = session('user_promo_code');
        $promo = $promoId ? \App\Models\PromoCode::with('products')->find($promoId) : null;

        if (Auth::check()) {
            $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        } else {
            $cart = session()->get('cart', []);
            $cartItems = [];
            foreach ($cart as $productId => $item) {
                $cartItems[] = (object)[
                    'product' => (object)[
                        'id' => $productId,
                        'price' => $item['price'],
                    ],
                    'quantity' => $item['quantity'],
                ];
            }
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $price = $item->product->price;
            $qty = $item->quantity;

            if ($promo && $promo->products->contains($item->product->id)) {
                $discountedUnit = $price * (1 - ($promo->discount_percent / 100));
                $total += $discountedUnit + ($price * ($qty - 1));
            } else {
                $total += $price * $qty;
            }
        }

        return response()->json([
            'total' => number_format($total, 2)
        ]);
    }


    public function count(){
        if (Auth::check()) {
            $count = CartItem::where('user_id', Auth::id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            $count = collect($cart)->sum('quantity');
        }

        return response()->json(['count' => $count]);
    }


    public function remove($productId){
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

    public function clear(){
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return redirect()->back()->with('success', 'Cart cleared!');
    }

    public function checkout(){
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

        $promoId = session('user_promo_code');
        $promo = $promoId ? \App\Models\PromoCode::with('products')->find($promoId) : null;

        $subtotal = 0;
        foreach ($cart as $item) {
            $price = Auth::check() ? $item->product->price : ($item->price ?? 0);
            $qty = $item->quantity;

            if ($promo && $promo->products->contains($item->product->id ?? $item->id)) {
                $discountedUnit = $price * (1 - ($promo->discount_percent / 100));
                $subtotal += $discountedUnit + ($price * ($qty - 1));
            } else {
                $subtotal += $price * $qty;
            }
        }

        return view('cart.checkout', compact('cart', 'subtotal'));
    }


    public function confirm(Request $request){
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
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'required|string|max:20',
            'street'     => 'nullable|string|max:255',
            'apartment'  => 'nullable|string|max:255',
            'city'       => 'nullable|string|max:255',
            'notes'      => 'nullable|string',
            'shipping'   => 'required|in:0.00',
        ]);

        $cart = Auth::check()
            ? CartItem::with('product')->where('user_id', Auth::id())->get()->map(function ($item) {
                return [
                    'product_id' => $item->product->id,
                    'price'      => $item->product->price,
                    'quantity'   => $item->quantity,
                    'product'    => $item->product,
                ];
            })
            : collect(session()->get('cart', []));

        if ($cart->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $promoId = session('user_promo_code');
        $promo   = $promoId ? \App\Models\PromoCode::with('products')->find($promoId) : null;
        $user    = Auth::user();

        $subtotal = 0;
        foreach ($cart as $item) {
            $price = $item['price'];
            $qty   = $item['quantity'];

            if ($promo && $promo->products->pluck('id')->contains($item['product_id'])) {
                $discountedUnit = $price * (1 - ($promo->discount_percent / 100));
                $subtotal += $discountedUnit * $qty;
            } else {
                $subtotal += $price * $qty;
            }
        }

        $shipping = 0;
        $total    = $subtotal + $shipping;
        $ip = $request->ip();
        $orderCount = \App\Models\Order::where('ip_address', $ip)
            ->where('created_at', '>=', \Carbon\Carbon::now()->subMinutes(10))
            ->count();

        if ($orderCount > 3) { 
            \App\Models\BlockedIp::firstOrCreate(['ip_address' => $ip]);
            abort(403, 'Too many orders from your IP. Access denied.');
        }

        $order = Order::create([
            'user_id'    => Auth::check() ? Auth::id() : null,
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'],
            'street'     => $validated['street'],
            'apartment'  => $validated['apartment'],
            'city'       => $validated['city'],
            'notes'      => $validated['notes'],
            'shipping'   => $shipping,
            'total'      => $total,
            'status'     => 'pending',
            'ip_address' => $ip, 
        ]);

        foreach ($cart as $item) {
            $productId = $item['product_id'];
            $price     = $item['price'];
            $qty       = $item['quantity'];

            $appliedPromo = null;
            if ($promo && $promo->products->pluck('id')->contains($productId)) {
                $price = $price * (1 - ($promo->discount_percent / 100));
                $appliedPromo = $promo;
            }

            OrderItem::create([
                'order_id'       => $order->id,
                'product_id'     => $productId,
                'quantity'       => $qty,
                'price'          => $price,
                'promo_code_id'  => $appliedPromo?->id,
                'original_price' => $item['price'],
            ]);
        }

        if ($promo && $user) {
            RedeemedPromoCode::create([
                'user_id'     => $user->id,
                'promocode_id'=> $promo->id,
            ]);
            session()->forget('user_promo_code');
        }

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        $order->load([
            'orderItems.product.promocodes',
            'orderItems.product',
            'orderItems.promoCode',
        ]);

        try {
            Mail::send('emails.order_confirmation', ['order' => $order], function ($message) use ($order) {
                $message->to($order->email)
                    ->subject('Your Order Confirmation #' . $order->id);
                Log::info('Customer email sent', ['order' => $order->id, 'email' => $order->email]);
            });

            $ownerEmail = config('mail.owner_email');
            if ($ownerEmail && filter_var($ownerEmail, FILTER_VALIDATE_EMAIL)) {
                Mail::send('emails.new_order_notification', ['order' => $order], function ($message) use ($order, $ownerEmail) {
                    $message->from(config('mail.from.address'), config('mail.from.name'))
                        ->to($ownerEmail)
                        ->subject('🚨 New Order #' . $order->id);
                    Log::info('Owner notification sent', ['order' => $order->id]);
                });
            } else {
                Log::error('Invalid owner email', ['email' => $ownerEmail]);
            }
        } catch (\Exception $e) {
            Log::error('Mail Error: ' . $e->getMessage(), [
                'order' => $order->id,
                'trace' => $e->getTraceAsString()
            ]);
        }
        return redirect("/order/success/{$order->id}");
    }

    public function showSuccess(Order $order){
        return view('cart.success', ['order' => $order]);
    }
    public function boot(){
        View::composer('*', function ($view) {
            $cartCount = (new CartController)->count()->getData()->count;
            $view->with('cartCount', $cartCount);
        });
    }  

    public static function getCartCount(){
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->sum('quantity');
        }
        $cart = session()->get('cart', []);
        return collect($cart)->sum('quantity');
    }
}

