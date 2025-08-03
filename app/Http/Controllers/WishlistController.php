<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();
        } else {
            $productIds = session()->get('wishlist', []);
            $wishlists = Product::whereIn('id', $productIds)->get();
        }

        return view('wishlist', compact('wishlists'));
    }


    public function add(Request $request, $productId)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->exists();

            if (!$exists) {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                ]);
            }
        } else {
            $wishlist = session()->get('wishlist', []);
            if (!in_array($productId, $wishlist)) {
                $wishlist[] = $productId;
                session()->put('wishlist', $wishlist);
            }
        }

        return response()->json(['success' => true]);
    }


    public function remove($productId)
    {
        if (Auth::check()) {
            Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->delete();
        } else {
            $wishlist = session()->get('wishlist', []);
            $wishlist = array_filter($wishlist, function($id) use ($productId) {
                return $id != $productId;
            });
            session()->put('wishlist', $wishlist);
        }

        return back();
    }

    public function toggle(Request $request, $productId)
    {
        if (Auth::check()) {
            $wishlistItem = Wishlist::where('user_id', Auth::id())->where('product_id', $productId)->first();

            if ($wishlistItem) {
                $wishlistItem->delete();
                $inWishlist = false;
            } else {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                ]);
                $inWishlist = true;
            }

            $count = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $wishlist = session()->get('wishlist', []);

            if (in_array($productId, $wishlist)) {
                $wishlist = array_diff($wishlist, [$productId]);
                $inWishlist = false;
            } else {
                $wishlist[] = $productId;
                $inWishlist = true;
            }

            session()->put('wishlist', $wishlist);
            $count = count($wishlist);
        }

        return response()->json([
            'success' => true,
            'inWishlist' => $inWishlist,
            'count' => $count
        ]);
    }

    public function count()
    {
        if (Auth::check()) {
            $count = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $count = count(session()->get('wishlist', []));
        }

        return response()->json(['count' => $count]);
    }

}

