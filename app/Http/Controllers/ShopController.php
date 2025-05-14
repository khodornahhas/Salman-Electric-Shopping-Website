<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
   public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();

        return view('shop', compact('categories', 'brands', 'products'));
    }
}

