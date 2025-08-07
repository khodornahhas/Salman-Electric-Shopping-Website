<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $brandSlugs = null, $minPrice = 0, $maxPrice = 2500)
    {
        $categories = Category::all();
        $brands = Brand::withCount('products')->get();
        $query = Product::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $min = (float) $minPrice;
        $max = (float) $maxPrice;

       $query->where(function ($q) use ($min, $max) {
    $q->where(function ($priceQuery) use ($min, $max) {
        $priceQuery->whereRaw('
            CASE 
                WHEN sale_price IS NOT NULL AND sale_price < price THEN sale_price
                ELSE price
            END BETWEEN ? AND ?
        ', [$min, $max]);
    })
    ->orWhere('contact_for_price', true);
});
 

        if ($categorySlug && strtolower($categorySlug) !== 'all') {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($brandSlugs && strtolower($brandSlugs) !== 'all') {
            $brandSlugArray = explode(',', $brandSlugs);
            $brandIds = Brand::whereIn('slug', $brandSlugArray)->pluck('id')->toArray();

            if (!empty($brandIds)) {
                $query->whereIn('brand_id', $brandIds);
            }
        }

        if ($request->sort == 'low_high') {
            $query->orderByRaw('
                CASE 
                    WHEN sale_price IS NOT NULL AND sale_price < price THEN sale_price
                    ELSE price
                END ASC
            ');
        } elseif ($request->sort == 'high_low') {
            $query->orderByRaw('
                CASE 
                    WHEN sale_price IS NOT NULL AND sale_price < price THEN sale_price
                    ELSE price
                END DESC
            ');
        }

        $limit = $request->limit;
        $products = ($limit == 'all')
            ? $query->paginate(100000)->withQueryString()
            : $query->paginate(is_numeric($limit) ? (int)$limit : 12)->withQueryString();

        $wishlistProductIds = auth()->check()
            ? auth()->user()->wishlists()->pluck('product_id')->toArray()
            : session()->get('wishlist', []);

        return view('shop', compact(
            'categories', 'brands', 'products', 'wishlistProductIds',
            'categorySlug', 'brandSlugs', 'minPrice', 'maxPrice'
        ));
    }
}
