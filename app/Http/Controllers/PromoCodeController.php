<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use App\Models\Product;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promocodes = PromoCode::with('products')->paginate(10);
        return view('admin.promocodes.index', compact('promocodes'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.promocodes.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'nullable|string|size:8|unique:promocodes,code',
            'discount_percent' => 'required|integer|min:1|max:100',
            'expires_at' => 'nullable|date',
            'products' => 'required|array',
        ]);

        if (empty($data['code'])) {
            $data['code'] = PromoCode::generateCode();
        }

        $promo = PromoCode::create($data);
        $promo->products()->sync($data['products']);

        return redirect()->route('admin.promocodes.index')->with('success', 'Promo code created.');
    }

    public function destroy(PromoCode $promocode)
    {
        $usedInOrders = $promocode->orders()->exists() || \App\Models\OrderItem::where('promo_code_id', $promocode->id)->exists();

        if ($usedInOrders) {
            $promocode->is_active = false;
            $promocode->save();

            return redirect()->route('admin.promocodes.index')
                ->with('info', 'Promo code was used in orders, so it has been deactivated instead of deleted.');
        }

        $promocode->delete();
        return redirect()->route('admin.promocodes.index')->with('success', 'Promo code deleted successfully.');
    }


    public function redeemForm()
    {
        return view('user.promocodes.redeem');
    }

    public function applyRedeem(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:8',
        ]);

        $promo = PromoCode::with('products')
        ->where('code', $request->code)
        ->where('is_active', true)
        ->where(function ($q) {
            $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
        })
        ->first();


        if (!$promo) {
            return back()->withErrors(['code' => 'Invalid or expired promo code.']);
        }

        session(['user_promo_code' => $promo->id]);

        return redirect()->route('home')->with('success', 'Promo code applied! Discount will be visible on eligible products.');
    }

    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:8',
        ]);

        $promo = PromoCode::with('products')
            ->where('code', $request->code)
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>=', now());
            })
            ->first();

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired promo code.'
            ], 422);
        }

        if ($promo->users()->where('user_id', auth()->id())->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'You already used this promo code!'
            ], 422);
        }

        session()->put('user_promo_code', $promo->id);
        session()->save(); 

        return response()->json([
            'success' => true,
            'message' => 'Promo code applied successfully!',
            'promo_code' => $promo->code,
            'redirect_url' => url()->previous()
        ]);
    }
    public function checkActivePromo()
    {
        if (!auth()->check()) {
            return response()->json(['has_promo' => false]);
        }

        $promoId = session('user_promo_code');
        $promo = $promoId ? PromoCode::find($promoId) : null;

        return response()->json([
            'has_promo' => (bool)$promo,
            'promo_code' => $promo ? $promo->code : null,
            'discount' => $promo ? $promo->discount_percent : null
        ]);
    }
}

