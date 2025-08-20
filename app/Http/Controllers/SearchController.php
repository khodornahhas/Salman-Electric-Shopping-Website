<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        try {
            $products = Product::where('name', 'like', "%{$query}%")
                ->take(5)
                ->get(['id', 'name', 'image']);

            $totalProductsCount = Product::where('name', 'like', "%{$query}%")->count();

            $categories = Category::where('name', 'like', "%{$query}%")
                ->take(3)
                ->get(['id', 'name', 'slug']);

            $brands = Brand::where('name', 'like', "%{$query}%")
                ->take(3)
                ->get(['id', 'name', 'slug']);

            return response()->json([
                'products' => $products,
                'total_products_count' => $totalProductsCount, 
                'categories' => $categories,
                'brands' => $brands,
            ]);
        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => 'Search failed'], 500);
        }
    }

    public function searchAll(Request $request)
    {
        $query = $request->get('q');
        $type = $request->get('type', 'products');
        
        return view('search-results', compact('query', 'type'));
    }
}