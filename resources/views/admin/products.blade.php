@extends('layouts.admin')
@section('content')

<div class="w-full px-6 max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mt-2">
            Manage Products
        </h2>
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Product
        </a>
    </div>

    <div class="flex items-center max-w-md mx-auto bg-white rounded-full shadow-md px-4 py-2 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
        <input
            type="text"
            placeholder="Search Products..."
            class="ml-3 w-full bg-transparent focus:outline-none text-gray-700 placeholder-gray-400"
        />
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Image</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Brand</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">
                            <img src="{{ asset($product->image) }}" alt="Product Image" class="w-20 h-20 object-cover rounded">
                        </td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">
                            @if ($product->is_on_sale && $product->sale_price)
                                <span class="text-sm text-gray-500 line-through mr-2">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                                <span class="text-red-600 font-semibold">
                                    ${{ number_format($product->sale_price, 2) }}
                                </span>
                            @else
                                <span>${{ number_format($product->price, 2) }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $product->brand->name ?? '—' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-2 flex justify-center">
        {{ $products->links() }}
    </div>

</div>
@endsection
