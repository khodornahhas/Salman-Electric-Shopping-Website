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
            $item = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $productId)
                            ->first();

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
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image, 
                    'quantity' => $quantity,
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $user = Auth::user();
        $sessionId = session()->getId();

        $cartItems = CartItem::with('product')
            ->when($user, function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }, function ($query) use ($sessionId) {
                $query->where('session_id', $sessionId);
            })
            ->get();

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

        return response()->json(['success' => true]);
    }

    public function updateQuantity(Request $request)
{
    $productId = $request->input('product_id');
    $change = $request->input('change');

    if (Auth::check()) {
        $item = CartItem::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($item) {
            $item->quantity += $change;
            $item->quantity = max($item->quantity, 1); // Prevent zero or negative
            $item->save();
            return response()->json(['success' => true, 'quantity' => $item->quantity]);
        }
    }

    return response()->json(['success' => false], 400);
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
}

