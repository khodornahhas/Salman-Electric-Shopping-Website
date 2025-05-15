<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
public function index(Request $request)
{
    $categories = Category::all();
    $brands = Brand::all();
    $query = Product::query();

    if ($request->has('search') && !empty($request->search)) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    if ($request->has('min_price') && $request->has('max_price')) {
        $min = (float) $request->min_price;
        $max = (float) $request->max_price;

        $query->where(function($q) use ($min, $max) {
            $q->whereRaw('
                CASE 
                    WHEN is_on_sale = 1 AND sale_price IS NOT NULL THEN sale_price 
                    ELSE price 
                END BETWEEN ? AND ?
            ', [$min, $max]);
        });
    }

    if ($request->has('category') && !empty($request->category)) {
        $query->where('category_id', $request->category);
    }

    if ($request->sort == 'low_high') {
        $query->orderByRaw('CASE WHEN is_on_sale = 1 THEN sale_price ELSE price END ASC');
    } elseif ($request->sort == 'high_low') {
        $query->orderByRaw('CASE WHEN is_on_sale = 1 THEN sale_price ELSE price END DESC');
    }

    $limit = $request->limit;
    if ($limit == 'all') {
        $products = $query->get(); 
    } else {
        $perPage = is_numeric($limit) ? (int)$limit : 1000; 
        $products = $query->paginate($perPage)->withQueryString();
    }
    return view('shop', compact('categories', 'brands', 'products'));
    }



}

