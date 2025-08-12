@extends('layouts.admin')
@section('content')

<div class="w-full px-6 max-w-7xl mx-auto py-6">
    <div class="flex flex-col items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Manage Products
        </h2>

        <form method="GET" action="{{ route('admin.products') }}" id="filtersForm" 
            class="flex flex-col md:flex-row items-center gap-4 w-full max-w-5xl  p-4  ">
            <div class="flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 w-full md:w-1/3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                <input
                    type="text"
                    name="search"
                    id="search-products"
                    value="{{ request('search') }}"
                    placeholder="Search products..."
                    class="ml-3 w-full bg-transparent focus:outline-none text-sm text-gray-700 placeholder-gray-400"
                />
            </div>

            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                <span class="text-sm font-medium text-gray-600 whitespace-nowrap">
                    Filter By:
                </span>

                <select name="brand_id" id="filter-brand" 
                        class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">All Brands</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>

                <select name="category_id" id="filter-category" 
                        class="border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <a href="{{ route('admin.products.create') }}"
            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm">
                + Add Product
            </a>
        </form>
    </div>



    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-left text-gray-700 uppercase text-sm">
                        <th class="px-6 py-4 font-medium">Image</th>
                        <th class="px-6 py-4 font-medium">Name</th>
                        <th class="px-6 py-4 font-medium">Cost Price</th>
                        <th class="px-6 py-4 font-medium">Sale Price</th>
                        <th class="px-6 py-4 font-medium">Discount Price</th> 
                        <th class="px-6 py-4 font-medium">Brand</th>
                        <th class="px-6 py-4 font-medium">Category</th>
                        <th class="px-6 py-4 font-medium text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="products-table-body" class="divide-y divide-gray-100">
                    @include('admin.partials.products-table', ['products' => $products])
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
        <div class="mt-8 flex justify-center pagination-wrapper">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @endif
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.getElementById('filter-brand').addEventListener('change', () => {
    document.getElementById('filtersForm').submit();
});
document.getElementById('filter-category').addEventListener('change', () => {
    document.getElementById('filtersForm').submit();
});
$(document).ready(function() {
    let typingTimer;
    const typingDelay = 200; 

    $('#search-products').on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchProducts, typingDelay);
    });

    $('#filter-brand, #filter-category').on('change', function() {
        fetchProducts();
    });

    function fetchProducts(page = 1) {
        let search = $('#search-products').val();
        let brand = $('#filter-brand').val();
        let category = $('#filter-category').val();

        $.ajax({
            url: "{{ route('admin.products') }}",
            type: 'GET',
            data: {
                search: search,
                brand_id: brand,
                category_id: category,
                page: page
            },
            success: function(data) {
                $('#products-table-body').html(data);
            }
        });
    }

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchProducts(page);
    });
});
</script>
@endsection



