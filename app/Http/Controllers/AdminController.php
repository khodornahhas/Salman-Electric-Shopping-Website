<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard() {
        $productCount = \App\Models\Product::count();
        $orderCount = \App\Models\Order::count();
        $userCount = \App\Models\User::count();
        $messageCount = 0; 

        return view('admin.dashboard', compact('productCount', 'orderCount', 'userCount', 'messageCount'));
    }
    public function products() {
        $products = Product::with('brand')->paginate(4); 
        return view('admin.products', compact('products'));
        return view('admin.products', compact('products'));
    }

    public function users() {
        return view('admin.users');
    }

    public function orders() {
        return view('admin.orders');
    }

    public function stats() {
        return view('admin.stats');
    }
    public function create() {
    $brands = Brand::all();
    $categories = Category::all();
    return view('admin.products-create', compact('brands', 'categories'));
    }


    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image',
            'brand_id' => 'nullable|exists:brands,id',
            'is_available' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product created!');
    }

    public function edit(Product $product) {
        $brands = Brand::all();
        return view('admin.products-edit', compact('product', 'brands'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $validated['is_available'] = $request->has('is_available') ? 1 : 0;
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }


    public function destroy(Product $product) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return back()->with('success', 'Product deleted.');
    }
}
