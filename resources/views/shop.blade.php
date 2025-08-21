@extends('layouts.main')
@section('head')
    <title>Salman Electric - Shop</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
@endsection
@section('content')
<head>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
     * {
        font-family: 'Urbanist', sans-serif !important;
    }
    input[type=range].slider-thumb::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    height: 12px;
    width: 12px;
    background-color:rgb(2, 63, 160); 
    border-radius: 9999px;
    cursor: pointer;
    pointer-events: all;
    margin-top:14px;
    }

    input[type=range].slider-thumb::-moz-range-thumb {
    height: 1rem;
    width: 1rem;
    background-color: #3b82f6;
    border-radius: 9999px;
    cursor: pointer;
    pointer-events: all;
    }
    
    #filter-sidebar {
        transition: max-height 0.3s ease, padding 0.3s ease;
        overflow: hidden;
    }
    @media (max-width: 767px) {
        #filter-sidebar {
            max-height: 0;
            padding: 0;
        }
        #filter-sidebar.show {
            max-height: 1000px;
            padding: 1.5rem;
            border: 1px solid #ffffffff; 
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            background: white;
        }

        #filter-toggle-btn {
            display: block;
            margin-bottom: 1rem;
            background-color: #1e40af; 
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: bold;
            font-family: 'Open Sans', sans-serif;
            cursor: pointer;
            user-select: none;
        }
    }
    @media (min-width: 768px) {
        #filter-toggle-btn {
            display: none;
        }
        #filter-sidebar {
            max-height: none !important;
            padding: 1.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            background: white;
            overflow: visible;
        }
    }

    @media (max-width: 639px) {
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem; 
        }
    }

    @media (min-width: 768px) and (max-width: 1023px) {
        .container {
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }
        
        #filter-sidebar {
            width: 240px;
            min-width: 240px;
            margin-right: 1rem;
            padding: 1rem !important;
            border-right: 1px solid #e5e7eb;
        }
        
        #filter-sidebar .bg-white {
            padding: 0;
            background: transparent;
            box-shadow: none;
            border: none;
        }
        
        #filter-sidebar h3 {
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
            color: #1e40af;
            font-weight: 600;
        }
        
        #filter-sidebar .space-y-2.text-sm {
            font-size: 0.875rem;
            padding-left: 0.5rem;
        }
        
        .bg-white.border.border-gray-300 {
            background-color: #f3f4f6;
            margin-bottom: 1.25rem;
        }
        
        .product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.5rem;
        }
        
        .product-grid > div {
            padding: 1.25rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .product-grid a.bg-white {
            height: 180px;
            padding: 0.5rem;
        }
        
        .product-grid h3 {
            font-size: 0.9375rem;
            height: auto;
            margin: 0.75rem 0;
            line-height: 1.3;
        }
        
        .product-grid .text-lg {
            font-size: 1.125rem;
            margin: 0.5rem 0;
        }
        
        .product-grid .text-sm.line-through {
            font-size: 0.875rem;
        }
        
        .product-grid .add-to-cart {
            width: 100%;
            font-size: 0.875rem;
            padding: 0.5rem;
            margin-top: 0.75rem;
            border: 1px solid #e5e7eb;
        }
        
        .flex-col.md\:flex-row.md\:justify-between.md\:items-center.gap-4.mb-6 {
            flex-direction: row;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        #filter-form {
            width: 100%;
            max-width: 280px;
            order: 1;
        }
        
        .text-sm.text-gray-500 {
            order: 2;
            margin-left: auto;
        }
        
        .flex.items-center.justify-between.flex-wrap.gap-4.text-sm {
            width: 100%;
            order: 3;
            margin-top: 0.5rem;
        }
        
        #sort-select {
            width: 160px;
            order: 4;
        }
        
        .relative.h-10 {
            margin-bottom: 1.5rem;
        }
        
        .brand-checkbox {
            margin-right: 0.5rem;
        }
        
        button[type="submit"].w-full.bg-blue-600 {
            padding: 0.5rem;
            font-size: 0.875rem;
        }
    }

</style>

<div class="bg-blue-600 text-white font-bold py-4 px-4 md:px-16 text-left mt-[30px]">
    <div class="max-w-7xl mx-auto">
        <a href="{{ url('/home') }}" class="hover:underline opacity-70 transition-opacity duration-300">Home</a>
        <span class="opacity-50 mx-2"> &gt; </span>
        <span class="opacity-90">Shop</span>
    </div>
</div>


<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row">
        <button id="filter-toggle-btn" type="button">Filters</button>

        <div id="filter-sidebar" class="w-full md:w-64 lg:w-72 xl:w-80 pr-0 md:pr-6 mb-6 md:mb-0"style="margin-right:15px;">
        <div class="bg-white p-6 rounded-none shadow-none">
                <form id="filter-form" action="{{ route('shop') }}" method="GET" style="font-family: 'Open Sans', sans-serif;">
                    <div class="flex items-center justify-between mb-1 relative">      
                      <div class="flex items-center justify-between mb-2">
                        <h2 class="font-bold z-10 bg-white pr-2" style="font-size:25px; margin-right:22px;font-family: 'Open Sans', sans-serif;">Filters</h2>
                        <div class="flex gap-2 z-10 bg-white pl-2">
                           <a href="{{ route('shop') }}" class="bg-white border border-gray-300 text-gray-800 px-3 py-1.5 rounded-md hover:bg-gray-100 hover:border-gray-400 transition duration-200 text-sm font-medium shadow-sm" style="font-family: 'Open Sans', sans-serif;">
                                Clear Filters
                            </a>
                        </div>
                    </div>
                    </div>
                    <div class="border-b border-gray-300 mb-6"></div>

                    @php
                        $selectedBrands = isset($brandSlugs) && $brandSlugs !== 'all' ? explode(',', $brandSlugs) : ['all'];
                    @endphp

                    <div class="mb-6">
                        <h3 class="font-semibold mb-3" style="color:#004BA8">Categories</h3>
                        <div class="space-y-2 text-sm">
                            <div>
                                <input type="radio" name="category" value="" id="cat-all" class="hidden peer"
                                    {{ (!isset($categorySlug) || $categorySlug === null || $categorySlug === 'all') ? 'checked' : '' }}>
                                <label for="cat-all"
                                    class="uppercase cursor-pointer block transition-all duration-200 peer-checked:font-semibold peer-checked:text-blue-600 hover:underline">
                                    ▪ All Categories
                                </label>
                            </div>

                            @foreach($categories as $category)
                                <div>
                                    <input type="radio" name="category" value="{{ $category->slug }}" id="cat-{{ $category->id }}" class="hidden peer"
                                    {{ (isset($categorySlug) && $categorySlug === $category->slug) ? 'checked' : '' }}>
                                    <label for="cat-{{ $category->id }}"
                                        class="uppercase cursor-pointer block transition-all duration-200 peer-checked:font-semibold peer-checked:text-blue-600 hover:underline">
                                        ▪ {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-semibold mb-3" style="color:#004BA8">Brands</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="brands[]" value="all" id="brand-all"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                    {{ (empty($selectedBrands) || in_array('all', $selectedBrands)) ? 'checked' : '' }}
                                    onclick="toggleAllBrands(this)">
                                <label for="brand-all" class="cursor-pointer text-gray-800">All Brands</label>
                            </div>

                            @php
                                $otherBrands = $brands->where('name', 'Other Brands')->first();
                                $normalBrands = $brands->filter(fn($b) => $b->name !== 'Other Brands');
                            @endphp

                            @foreach($normalBrands as $brand)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" name="brands[]" value="{{ $brand->slug }}" id="brand-{{ $brand->id }}"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 brand-checkbox"
                                            {{ in_array($brand->slug, $selectedBrands) ? 'checked' : '' }}>
                                        <label for="brand-{{ $brand->id }}" class="cursor-pointer text-gray-800">
                                            {{ $brand->name }}
                                        </label>
                                    </div>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">
                                        {{ $brand->products_count ?? 0 }}
                                    </span>
                                </div>
                            @endforeach

                            @if($otherBrands)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" name="brands[]" value="{{ $otherBrands->slug }}" id="brand-{{ $otherBrands->id }}"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 brand-checkbox"
                                            {{ in_array($otherBrands->slug, $selectedBrands) ? 'checked' : '' }}>
                                        <label for="brand-{{ $otherBrands->id }}" class="cursor-pointer text-gray-800">
                                            {{ $otherBrands->name }}
                                        </label>
                                    </div>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">
                                        {{ $otherBrands->products_count ?? 0 }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @php
                        $minPrice = request()->route('minPrice') ?? 0;
                        $maxPrice = request()->route('maxPrice') ?? 2500;
                        $maxPriceLimit = 2500;
                    @endphp

                    <div class="mb-2">
                        <h3 class="font-semibold mb-3" style="font-family: 'Open Sans', sans-serif; color:#004BA8">Price ($)</h3>
                        <div class="flex justify-between text-sm text-gray-700 mb-2">
                            <span>Min: $<span id="min-val">{{ $minPrice }}</span></span>
                            <span>Max: $<span id="max-val">{{ $maxPrice }}</span></span>
                        </div>
                        <div class="relative h-10">
                            <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-300 rounded transform -translate-y-1/2"></div>
                            <div id="slider-track" class="absolute top-1/2 h-1 bg-blue-500 rounded transform -translate-y-1/2 z-10"></div>
                            <input id="min-range" type="range" min="0" max="{{ $maxPriceLimit }}" value="{{ $minPrice }}" step="10" class="absolute w-full pointer-events-none appearance-none z-20 bg-transparent slider-thumb">
                            <input id="max-range" type="range" min="0" max="{{ $maxPriceLimit }}" value="{{ $maxPrice }}" step="10" class="absolute w-full pointer-events-none appearance-none z-20 bg-transparent slider-thumb">
                            <input type="hidden" name="min_price" id="min-price-input" value="{{ $minPrice }}">
                            <input type="hidden" name="max_price" id="max-price-input" value="{{ $maxPrice }}">
                        </div>
                        <div class="flex items-center gap-2 mt-4">
                            <input 
                                type="number" 
                                placeholder="0" 
                                class="w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                name="min_price_manual"
                                value="{{ $minPrice }}"
                            />
                            <span class="text-gray-500 text-sm">to</span>
                            <input 
                                type="number" 
                                placeholder="2500" 
                                class="w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                name="max_price_manual"
                                value="{{ $maxPrice }}"
                            />
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                            Apply Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

   <div class="flex-1">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
            <div class="text-sm text-gray-500">{{ $products->count() }} items</div>

            <div id="filter-form" class="relative w-full sm:w-64">
                @if(request('limit')) <input type="hidden" name="limit" value="{{ request('limit') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search products..." 
                    class="w-full pl-10 pr-4 py-2 rounded border border-gray-300 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <i class='bx bx-search absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500 text-lg'></i>
            </div>
        </div>

        <form method="GET" action="{{ route('shop') }}" class="flex flex-wrap items-center justify-end gap-4 w-full sm:w-auto">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if(request('min_price'))
                <input type="hidden" name="min_price" value="{{ request('min_price') }}">
            @endif
            @if(request('max_price'))
                <input type="hidden" name="max_price" value="{{ request('max_price') }}">
            @endif
            @if(request()->has('brands') && is_array(request('brands')))
                @foreach(request('brands') as $brandId)
                    <input type="hidden" name="brands[]" value="{{ $brandId }}">
                @endforeach
            @endif

            <div class="flex items-center justify-between flex-wrap gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <span class="text-gray-700 font-medium">Show:</span>
                    @foreach([6, 12, 32, 'all'] as $limit)
                        <form method="GET" action="{{ url()->current() }}">
                            @foreach(request()->except('limit', 'page') as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $v)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach
                            <button 
                                type="submit" 
                                name="limit" 
                                value="{{ $limit }}" 
                                class="px-2 py-1 rounded border hover:bg-gray-200 transition text-gray-700 {{ request('limit') == $limit ? 'bg-gray-300 font-semibold' : '' }}">
                                {{ $limit === 'all' ? 'All' : $limit }}
                            </button>
                        </form>
                    @endforeach
                </div>

                @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="mt-1">
                        {{ $products->onEachSide(1)->links('pagination::tailwind') }}
                    </div>
                @endif
            </div>    

            <div>
                <select name="sort" id="sort-select" class="p-2 border rounded text-sm">
                    <option value="">Default</option>
                    <option value="low_high" {{ request('sort') == 'low_high' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="high_low" {{ request('sort') == 'high_low' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                </select>
            </div>
        </form>
    </div>

    <div class="grid product-grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col group w-full">

            <div class="absolute top-2 right-2 z-10 flex items-center space-x-2">
                <div class="cursor-pointer wishlist-btn" data-product-id="{{ $product->id }}">
                    <i class="wishlist-icon bx {{ in_array($product->id, $wishlistProductIds) ? 'bxs-heart text-red-500' : 'bx-heart text-gray-400' }} text-2xl"></i>
                </div>
            </div>

            @if($product->coming_soon)
                <div class="absolute top-2 left-2 z-10 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
                    Coming Soon
                </div>
            @elseif($product->sale_price && $product->sale_price < $product->price)
                <div class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                    On Sale
                </div>
            @endif

            <a href="{{ route('product.details', $product->id) }}" class="bg-white w-full h-60 flex items-center justify-center overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-contain w-full h-full">
                @else
                    <span class="text-gray-400">No Image</span>
                @endif
            </a>

            <div class="p-5 flex flex-col flex-grow">
                <h3 class="font-semibold text-gray-800 h-12 overflow-hidden text-center" style="font-family: 'Open Sans', sans-serif; font-size:15px;">
                    {{ $product->name }}
                </h3>

                <div class="mt-auto text-center">
                    @if($product->coming_soon)

                        @if($product->sale_price && $product->sale_price < $product->price)
                            <p class="text-gray-500 text-sm line-through">
                                ${{ number_format($product->price, 2) }}
                            </p>
                            <p class="text-red-600 text-lg font-bold">
                                ${{ number_format($product->sale_price, 2) }}
                            </p>
                        @else
                            <p class="text-red-600 text-lg font-bold">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        @endif

                    @elseif($product->contact_for_price)
                        <p class="text-red-600 text-lg font-bold italic">Contact for Price</p>
                        <p class="text-sm text-gray-500 italic">Please reach out for pricing</p>

                    @elseif($product->quantity == 0 || $product->out_of_stock)
                        <p class="text-red-600 text-lg font-bold italic mb-2">Out of Stock</p>

                    @elseif($product->sale_price && $product->sale_price < $product->price)
                        <p class="text-gray-500 text-sm line-through">
                            ${{ number_format($product->price, 2) }}
                        </p>
                        <p class="text-red-600 text-lg font-bold">
                            ${{ number_format($product->sale_price, 2) }}
                        </p>

                    @else
                        <p class="text-red-600 text-lg font-bold">
                            ${{ number_format($product->price, 2) }}
                        </p>
                    @endif
   



                            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="cart-form">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            @php
                                $disableAddToCart = $product->out_of_stock || $product->coming_soon || $product->contact_for_price;
                            @endphp
                            <button type="submit"
                                class="mt-2 w-44 sm:w-44 w-auto mx-auto bg-gray-100 font-medium py-2 rounded transition add-to-cart
                                    {{ $disableAddToCart ? 'cursor-not-allowed opacity-50' : 'hover:bg-gray-200' }}"
                                {{ $disableAddToCart ? 'disabled' : '' }}
                                data-product-id="{{ $product->id }}" data-quantity="1"
                                style="font-size:18px; color:grey;">
                                Add to Cart
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/wishlist.js') }}"></script>
<script>
    // ------------------ PRICE RANGE SLIDER ------------------
    const maxPriceLimit = {{ $maxPriceLimit }};
    const minRange = document.getElementById('min-range');
    const maxRange = document.getElementById('max-range');
    const minVal = document.getElementById('min-val');
    const maxVal = document.getElementById('max-val');
    const sliderTrack = document.getElementById('slider-track');
    const minPriceInput = document.getElementById('min-price-input');
    const maxPriceInput = document.getElementById('max-price-input');
    const minInputBox = document.querySelector('input[name="min_price_manual"]');
    const maxInputBox = document.querySelector('input[name="max_price_manual"]');
    const filterForm = document.getElementById('filter-form');

    function updateSlider(event) {
        let min = parseInt(minRange.value);
        let max = parseInt(maxRange.value);

        if (max - min < 50) {
            if (event.target.id === "min-range") {
                minRange.value = max - 50;
                min = max - 50;
            } else {
                maxRange.value = min + 50;
                max = min + 50;
            }
        }

        minVal.textContent = min;
        maxVal.textContent = max;
        minPriceInput.value = min;
        maxPriceInput.value = max;

        minInputBox.value = min;
        maxInputBox.value = max;

        const percent1 = (min / maxPriceLimit) * 100;
        const percent2 = (max / maxPriceLimit) * 100;
        sliderTrack.style.left = percent1 + "%";
        sliderTrack.style.right = (100 - percent2) + "%";
    }

    function updateSliderFromInput() {
        let min = parseInt(minInputBox.value) || 0;
        let max = parseInt(maxInputBox.value) || maxPriceLimit;

        min = Math.max(0, Math.min(min, maxPriceLimit));
        max = Math.max(0, Math.min(max, maxPriceLimit));

        if (max - min < 50) {
            if (minInputBox === document.activeElement) {
                min = max - 50;
                minInputBox.value = min;
            } else {
                max = min + 50;
                maxInputBox.value = max;
            }
        }

        minRange.value = min;
        maxRange.value = max;
        minVal.textContent = min;
        maxVal.textContent = max;
        minPriceInput.value = min;
        maxPriceInput.value = max;

        const percent1 = (min / maxPriceLimit) * 100;
        const percent2 = (max / maxPriceLimit) * 100;
        sliderTrack.style.left = percent1 + "%";
        sliderTrack.style.right = (100 - percent2) + "%";
    }

    // Initialize slider positions
    minRange.value = {{ $minPrice }};
    maxRange.value = {{ $maxPrice }};
    minInputBox.value = {{ $minPrice }};
    maxInputBox.value = {{ $maxPrice }};
    updateSlider({ target: minRange });

    // ------------------ BRAND & CATEGORY FILTERS ------------------
    function toggleAllBrands(allCheckbox) {
        const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
        if (allCheckbox.checked) {
            brandCheckboxes.forEach(cb => cb.checked = false);
        }
    }

    // ------------------ Build SEO URL ------------------
    function buildSeoUrl() {
    const categoryInput = document.querySelector('input[name="category"]:checked');
    const categorySlug = categoryInput && categoryInput.value.trim() !== '' ? categoryInput.value : 'all';

    const brandInputs = document.querySelectorAll('input[name="brands[]"]:checked');
    let brandSlugs = [];
    brandInputs.forEach(input => {
        if (input.value !== 'all') brandSlugs.push(input.value);
    });
    if (brandSlugs.length === 0) brandSlugs = ['all'];

    const minPrice = minInputBox.value || '0';
    const maxPrice = maxInputBox.value || '2500';

    const path = `/shop/${encodeURIComponent(categorySlug)}/brands/${encodeURIComponent(brandSlugs.join(','))}/min-price/${encodeURIComponent(minPrice)}/max-price/${encodeURIComponent(maxPrice)}`;

    const params = new URLSearchParams();

    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput && searchInput.value.trim() !== '') {
        params.set('search', searchInput.value.trim());
    }

    const sortSelect = document.querySelector('select[name="sort"]');
    if (sortSelect && sortSelect.value) {
        params.set('sort', sortSelect.value);
    }

    const limitInput = document.querySelector('input[name="limit"]');
    if (limitInput && limitInput.value) {
        params.set('limit', limitInput.value);
    }

    return path + (params.toString() ? `?${params.toString()}` : '');
    }

    // ------------------ Debounce Function ------------------
    function debounce(fn, delay) {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    const debouncedRedirect = debounce(() => {
        const url = buildSeoUrl();
        window.location.href = url;
    }, 3000);

    // ------------------ Handle Filter Change ------------------
    function onFilterChange(e) {
        e.preventDefault();
        const url = buildSeoUrl();
        window.location.href = url;
    }

    filterForm.addEventListener('submit', onFilterChange);
    document.querySelectorAll('input[name="category"], input[name="brands[]"]').forEach(input => {
        input.addEventListener('change', onFilterChange);
    });

    // ------------------ PRICE RANGE LISTENERS ------------------
    minRange.addEventListener('input', (e) => {
        updateSlider(e);
        
    });

    maxRange.addEventListener('input', (e) => {
        updateSlider(e);
        
    });

    minInputBox.addEventListener('input', () => {
        updateSliderFromInput();
        
    });

    maxInputBox.addEventListener('input', () => {
        updateSliderFromInput();
        
    });

    // ------------------ WISHLIST TOGGLE ------------------
    document.addEventListener('DOMContentLoaded', function () {
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const productId = this.getAttribute('data-product-id');
                const icon = this.querySelector('.wishlist-icon');

                fetch('/wishlist', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        if (data.inWishlist) {
                            icon.classList.remove('bx-heart', 'text-gray-400');
                            icon.classList.add('bxs-heart', 'text-red-500');
                        } else {
                            icon.classList.remove('bxs-heart', 'text-red-500');
                            icon.classList.add('bx-heart', 'text-gray-400');
                        }
                        updateWishlistCount();
                    } else {
                        alert('Wishlist failed: ' + data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Something went wrong');
                });
            });
        });
    });

    // ------------------ SEARCH INPUT ENTER ------------------
    document.querySelector('input[name="search"]').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const url = buildSeoUrl();
            window.location.href = url;
        }
    });

    document.getElementById('sort-select').addEventListener('change', function () {
    const url = buildSeoUrl();
    window.location.href = url;
});
  document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('filter-toggle-btn');
    const filterSidebar = document.getElementById('filter-sidebar');

    toggleBtn.addEventListener('click', () => {
      filterSidebar.classList.toggle('show');
    });
  });

</script>

@endsection
