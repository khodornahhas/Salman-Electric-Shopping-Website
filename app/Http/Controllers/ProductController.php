<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all(); 
    $featuredProducts = Product::where('is_featured', true)->get();
    $saleProducts = Product::where('is_on_sale', true)->get();

    return view('home', compact('products', 'featuredProducts', 'saleProducts'));
}
}