<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
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
    public function products(Request $request) {
        $brands = Brand::all();
        $categories = Category::all();
        $query = Product::with(['brand', 'category']);
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(4);
        if ($request->ajax()) {
            return view('admin.partials.products-table', compact('products'))->render();
        }
        return view('admin.products', compact('products', 'brands', 'categories'));
    }


   public function users()
    {
        $users = \App\Models\User::withCount('orders')->paginate(5);
        return view('admin.users', compact('users'));
    }

    public function orders() {
        $orders = Order::with(['user', 'orderItems.product'])->latest()->paginate(5);
        return view('admin.orders', compact('orders'));
    }

    public function messages() {
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
            'information' => 'nullable|string', 
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image',
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'required|exists:categories,id',   
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
    public function searchProducts(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with(['brand', 'category'])
            ->where('name', 'LIKE', "%$query%")
            ->orWhereHas('brand', function($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%");
            })
            ->limit(10)
            ->get();

        return view('admin.partials.products-table', compact('products'))->render();
    }
    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
    public function deleteOrder($id) {
    $order = Order::findOrFail($id);
    $order->delete();
    return redirect()->back()->with('success', 'Order deleted.');
    }   


}
