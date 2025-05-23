<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
  public function index()
    {
    $products = Product::all(); 
    $featuredProducts = Product::where('is_featured', true)->get();
    $saleProducts = Product::where('is_on_sale', true)->get();
    $latestProducts = Product::where('is_latest', true)->get();
    $categories = Category::all(); 
    $brands = Brand::all();

    return view('home', compact(
        'products',
        'featuredProducts',
        'saleProducts',
        'latestProducts',
        'categories',
        'brands'
    ));
    }

  public function show($id)
  {
      $product = Product::with(['category', 'brand'])->findOrFail($id);
      $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)
      ->inRandomOrder()->take(3)->get();

      return view('product-details', compact('product', 'relatedProducts'));
  }

}