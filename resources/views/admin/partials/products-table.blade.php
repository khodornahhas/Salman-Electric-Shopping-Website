@forelse ($products as $product)
    <tr class="hover:bg-gray-50 transition">
        <td class="px-6 py-4">
            <img 
                src="{{ asset('storage/' . $product->image) }}" 
                alt="Product Image"
                class="w-20 h-20 object-contain rounded" 
            >
        </td>
        <td class="px-6 py-4 font-medium text-gray-800">{{ $product->name }}</td>

        <td class="px-6 py-4">
            @if($product->unit_price !== null)
                <span class="font-medium">${{ number_format($product->unit_price, 2) }}</span>
            @else
                <span class="text-gray-400 italic">N/A</span>
            @endif
        </td>

       <td class="px-6 py-4">
            @if ($product->contact_for_price)
                <span class="font-medium text-blue-600">Contact for Price</span>
            @elseif ($product->price !== null)
                <span class="font-medium">${{ number_format($product->price, 2) }}</span>
                @if ($product->coming_soon)
                    <span class="ml-2 text-yellow-600 italic">(Coming Soon)</span>
                @endif
            @else
                <span class="text-gray-400 italic">N/A</span>
            @endif
        </td>


        <td class="px-6 py-4">
            @if($product->sale_price && $product->sale_price > 0)
                <span class="font-medium text-red-600">${{ number_format($product->sale_price, 2) }}</span>
            @else
                <span class="text-gray-400 italic">N/A</span>
            @endif
        </td>

        <td class="px-6 py-4">{{ $product->brand->name ?? '—' }}</td>
        <td class="px-6 py-4">{{ $product->category->name ?? '—' }}</td>
        <td class="px-6 py-4">
            @if($product->quantity > 0)
                {{ $product->quantity }}
            @else
                <span class="text-red-600 font-semibold">Out of Stock</span>
            @endif
        </td>

        <td class="px-6 py-4 text-right">
            <div class="inline-flex items-center gap-2">
                <a href="{{ route('admin.products.edit', $product->id) }}"
                   class="inline-flex items-center text-sm bg-blue-50 text-blue-700 px-3 py-2 rounded-lg hover:bg-blue-100 transition border border-blue-100 min-w-[90px] justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1 0v14m-7-7h14" />
                    </svg>
                    Edit
                </a>

                <form action="{{ route('admin.products.destroy', [$product->id] + request()->query()) }}" method="POST" class="inline-block m-0 p-0"
                      onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center text-sm bg-red-50 text-red-700 px-3 py-2 rounded-lg hover:bg-red-100 transition border border-red-100 min-w-[90px] justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        <td colspan="9" class="py-16 text-center text-gray-400">
            No products found
        </td>
    </tr>
@endforelse

@if ($products->hasPages())
    <tr>
        <td colspan="9" class="px-6 py-4">
            {!! $products->links('pagination::tailwind') !!}
        </td>
    </tr>
@endif
