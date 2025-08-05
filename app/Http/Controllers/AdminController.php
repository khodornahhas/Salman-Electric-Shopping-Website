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


    public function users(Request $request)
    {
        $query = User::withCount('orders');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(5);

        if ($request->ajax()) {
            return view('admin.partials.user-table', compact('users'))->render();
        }

        return view('admin.users', compact('users'));
    }

    public function orders(Request $request)
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->latest()
            ->paginate(5);

        return view('admin.orders', compact('orders'));
    }

    public function searchOrders(Request $request)
    {
        $query = $request->input('q');

        $orders = Order::with(['user', 'orderItems.product'])
            ->whereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                ->orWhere('phone', 'like', "%$query%")
                ->orWhere('location', 'like', "%$query%");
            })
            ->orWhere('phone', 'like', "%$query%")
            ->orWhere('city', 'like', "%$query%")
            ->latest()
            ->paginate(5);

        return view('admin.partials.order-table', compact('orders'))->render();
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
            'is_on_sale' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_latest' => 'nullable|boolean',
        ]);

        $validated['is_available'] = $request->has('is_available') ? 1 : 0;
        $validated['is_on_sale'] = $request->has('is_on_sale') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['is_latest'] = $request->has('is_latest') ? 1 : 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product created!');
    }


    public function edit(Product $product) {
        $brands = Brand::all();
        $categories = Category::all(); 
        return view('admin.products-edit', compact('product', 'brands', 'categories'));
    }   


    public function update(Request $request, Product $product)
    {
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
            'is_on_sale' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_latest' => 'nullable|boolean',
        ]);

        $validated['is_available'] = $request->has('is_available') ? 1 : 0;
        $validated['is_on_sale'] = $request->has('is_on_sale') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['is_latest'] = $request->has('is_latest') ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        } else {
            $validated['image'] = $product->image;
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
