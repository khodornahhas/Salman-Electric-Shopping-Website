<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\BlockedIp;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{   
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10)->appends($request->query());

        $brands = Brand::all();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'brands', 'categories'));
    }

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

        if ($request->price_sort === 'low_high') {
            $query->orderBy('price', 'asc');
        } elseif ($request->price_sort === 'high_low') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(4)->appends($request->query());

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
    public function store(Request $request)
    {
        $request->merge([
            'out_of_stock' => $request->has('out_of_stock') && $request->out_of_stock === 'on' ? 1 : 0,
        ]);

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'information' => 'nullable|string',
            'price' => 'nullable|numeric',           
            'sale_price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'out_of_stock' => 'sometimes|boolean',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'brand_id' => 'required|exists:brands,id',       
            'category_id' => 'required|exists:categories,id',
            'is_available' => 'sometimes|boolean',
            'is_on_sale' => 'sometimes|boolean',
            'is_featured' => 'sometimes|boolean',
            'is_latest' => 'sometimes|boolean',
            'unit_price' => 'nullable|numeric',
            'coming_soon' => 'sometimes|boolean',
        ]);

        $contactForPrice = $request->has('contact_for_price');
        $comingSoon = $request->has('coming_soon');

        if (!$comingSoon && !$contactForPrice && (!$request->filled('price') || $request->price === null || $request->price === '')) {
            $contactForPrice = true;
        }

        if ($validated['out_of_stock']) {
            $validated['quantity'] = 0;
        } else {
            $validated['quantity'] = $request->filled('quantity') ? $request->quantity : 1;
        }

        if ($contactForPrice && !$comingSoon) {
            $validated['price'] = null;
            $validated['sale_price'] = null;
        } else {
            $validated['price'] = $request->filled('price') ? $request->price : null;
            $validated['sale_price'] = $request->filled('sale_price') ? $request->sale_price : null;
        }

        $validated['contact_for_price'] = $contactForPrice ? 1 : 0;
        $validated['unit_price'] = $request->filled('unit_price') ? $request->unit_price : null;

        $validated['is_available'] = $request->has('is_available') ? 1 : 0;
        $validated['is_on_sale'] = $request->has('is_on_sale') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['is_latest'] = $request->has('is_latest') ? 1 : 0;
        $validated['coming_soon'] = $comingSoon ? 1 : 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            $order = 1; 
            foreach (array_slice($request->file('images'), 0, 4) as $img) {
                $path = $img->store('products', 'public');
                $product->images()->create([
                    'image' => $path,
                    'order' => $order++ 
                ]);
            }
        }
        return redirect()->route('admin.products')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $categories = Category::all(); 
        return view('admin.products-edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $isContact = $request->has('contact_for_price');
        $comingSoon = $request->has('coming_soon');

        if ($request->has('out_of_stock') && $request->out_of_stock === 'on') {
            $request->merge(['out_of_stock' => true]);
        } else {
            $request->merge(['out_of_stock' => false]);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'information' => 'nullable|string',
            'price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'out_of_stock' => 'sometimes|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'is_on_sale' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_latest' => 'nullable|boolean',
            'contact_for_price' => 'nullable|boolean',
            'unit_price' => 'nullable|numeric',
            'coming_soon' => 'nullable|boolean',
        ]);


        if ($isContact && !$comingSoon) {
            $validated['price'] = null;
            $validated['sale_price'] = null;
        } else {
            $validated['price'] = $request->filled('price') ? $request->price : null;
            $validated['sale_price'] = $request->filled('sale_price') ? $request->sale_price : null;
        }

        if ($request->out_of_stock) {
            $validated['quantity'] = 0;
            $validated['out_of_stock'] = 1;
        } else {
            $validated['quantity'] = $request->filled('quantity') ? $request->quantity : 1;
            $validated['out_of_stock'] = 0;
        }

        $validated['unit_price'] = $request->filled('unit_price') ? $request->unit_price : null;

        $validated['is_on_sale'] = $request->has('is_on_sale') ? 1 : 0;
        $validated['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $validated['is_latest'] = $request->has('is_latest') ? 1 : 0;
        $validated['contact_for_price'] = $isContact ? 1 : 0;
        $validated['coming_soon'] = $comingSoon ? 1 : 0;

        if ($request->hasFile('image')) {
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        } else {
            $validated['image'] = $product->image;
        }

        $product->update($validated);

        if ($request->hasFile('images')) {
            $currentMaxOrder = $product->images()->max('order') ?? 0;
            $order = $currentMaxOrder + 1;
            
            $remainingSlots = 4 - $product->images()->count();
            
            if ($remainingSlots > 0) {
                foreach (array_slice($request->file('images'), 0, $remainingSlots) as $img) {
                    $path = $img->store('products', 'public');
                    $product->images()->create([
                        'image' => $path,
                        'order' => $order++
                    ]);
                }
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }

    public function destroy(Product $product, Request $request)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('admin.products', $request->query())
            ->with('success', 'Product deleted.');
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

    public function categories()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.categories', compact('categories', 'brands'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category added!');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete this category because it has products.');
        }

        $category->delete();

        return back()->with('success', 'Category deleted!');
    }

    public function brands()
    {
        $brands = Brand::all()
            ->sortBy(function ($brand) {
                return $brand->slug === 'other-brands' ? 'zzz' : strtolower($brand->name);
            })
            ->values();

        return view('admin.brands', compact('brands'));
    }

    public function storeBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ]);

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.brands')->with('success', 'Brand added successfully.');
    }

    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return back()->with('success', 'Brand deleted!');
    }

    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:brands,name,' . $id,
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();

        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully.');
    }
    
    public function blockedIps()
    {
        $blockedIps = BlockedIp::latest()->get();
        return view('admin.blocked_ips', compact('blockedIps'));
    }

    public function unblockIp($id)
    {
        $ip = BlockedIp::findOrFail($id);
        $ip->delete();
        return redirect()->back()->with('success', 'IP unblocked successfully.');
    }
}
