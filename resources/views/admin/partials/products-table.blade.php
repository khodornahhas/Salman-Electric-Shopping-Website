@forelse ($products as $product)
    <tr class="hover:bg-gray-50 transition">
        <td class="px-6 py-4">
            <img src="{{ asset($product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
        </td>
        <td class="px-6 py-4 font-medium text-gray-800">{{ $product->name }}</td>
        <td class="px-6 py-4">
            @if ($product->is_on_sale && $product->sale_price)
                <div class="flex items-center">
                    <span class="text-sm text-gray-500 line-through mr-2">
                        ${{ number_format($product->price, 2) }}
                    </span>
                    <span class="text-red-600 font-semibold">
                        ${{ number_format($product->sale_price, 2) }}
                    </span>
                </div>
            @else
                <span class="font-medium">${{ number_format($product->price, 2) }}</span>
            @endif
        </td>
        <td class="px-6 py-4">{{ $product->brand->name ?? '—' }}</td>
        <td class="px-6 py-4">{{ $product->category->name ?? '—' }}</td>
        <td class="px-6 py-4">
            <div class="flex justify-end items-center space-x-3">
                <a href="{{ route('admin.products.edit', $product->id) }}"
                class="inline-flex items-center text-sm bg-blue-50 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-100 transition border border-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1 0v14m-7-7h14" />
                    </svg>
                    Edit
                </a>

                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center text-sm bg-red-50 text-red-700 px-4 py-2 rounded-lg hover:bg-red-100 transition border border-red-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-8 text-gray-500">
            <div class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg">No products found</p>
                <p class="text-sm text-gray-500 mt-1">Add your first product to get started</p>
            </div>
        </td>
    </tr>
@endforelse
