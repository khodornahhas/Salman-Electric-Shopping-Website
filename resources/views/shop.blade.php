@extends('layouts.main')

@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
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
    
</style>

    <div class="bg-blue-600 text-white font-bold py-4 pl-32 text-left mb-6" style="margin-top: 30px; font-size: 20px; font-family: 'Open Sans', sans-serif;">
        <span style="opacity: 0.4;">Home</span> <span style="opacity: 0.4;">&gt;</span> <span style="opacity: 0.9;">Shop</span>
    </div>

    <div class="container mx-auto px-4 py-8">
    

    <div class="flex flex-col md:flex-row">
    <div class="w-full md:w-64 lg:w-72 xl:w-80 pr-0 md:pr-6 mb-6 md:mb-0">
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">


    <form id="filter-form" action="{{ route('shop') }}" method="GET"style="font-family: 'Open Sans', sans-serif;">

    <div class="flex items-center justify-between mb-1 relative">      
      <div class="flex items-center justify-between mb-2">
        <h2 class="font-bold z-10 bg-white pr-2"style="font-size:25px; margin-right:22px;font-family: 'Open Sans', sans-serif;">Filters</h2>
        <div class="flex gap-2 z-10 bg-white pl-2">
           <a href="{{ route('shop') }}"class="bg-white border border-gray-300 text-gray-800 px-3 py-1.5 rounded-md hover:bg-gray-100 hover:border-gray-400 transition duration-200 text-sm font-medium shadow-sm"style="font-family: 'Open Sans', sans-serif;">
                Clear Filters
            </a>
        </div>
    </div>
    </div>
    <div class="border-b border-gray-300 mb-6"></div>
        <div class="mb-6">
    <h3 class="font-semibold mb-3"style="color:#004BA8">Categories</h3>
    <div class="space-y-2 text-sm">
        <div>
            <input type="radio" name="category" value="" id="cat-all" class="hidden peer"
                {{ request()->get('category') == null ? 'checked' : '' }}>
            <label for="cat-all"
                class="uppercase cursor-pointer block transition-all duration-200 peer-checked:font-semibold peer-checked:text-blue-600
                       hover:underline">
                ▪ All Categories
            </label>
        </div>

        @foreach($categories as $category)
            <div>
                <input type="radio" name="category" value="{{ $category->id }}" id="cat-{{ $category->id }}" class="hidden peer"
                    {{ request()->get('category') == $category->id ? 'checked' : '' }}>
                <label for="cat-{{ $category->id }}"
                    class="uppercase cursor-pointer block transition-all duration-200 peer-checked:font-semibold peer-checked:text-blue-600
                           hover:underline">
                    ▪ {{ $category->name }}
                </label>
            </div>
        @endforeach
    </div>
</div>


    <div class="mb-6">
    <h3 class="font-semibold mb-3"style="color:#004BA8">Brands</h3>
    <div class="space-y-2 text-sm">
        <div class="flex items-center gap-2">
            <input type="checkbox" name="brands[]" value="all" id="brand-all"
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                {{ empty(request('brands')) || in_array('all', (array)request('brands')) ? 'checked' : '' }}
                onclick="toggleAllBrands(this)">
            <label for="brand-all" class="cursor-pointer text-gray-800">All Brands</label>
        </div>

        @foreach($brands as $brand)
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="brands[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 brand-checkbox"
                        {{ is_array(request('brands')) && in_array($brand->id, request('brands')) ? 'checked' : '' }}>
                    <label for="brand-{{ $brand->id }}" class="cursor-pointer text-gray-800">
                        {{ $brand->name }}
                    </label>
                </div>
                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-medium">
                    {{ $brand->products_count ?? 0 }}
                </span>
            </div>
        @endforeach
        </div>
    </div>

     <div class="mb-2">
            <h3 class="font-semibold mb-3"style="font-family: 'Open Sans', sans-serif;color:#004BA8">Price ($)</h3>
            <div class="flex justify-between text-sm text-gray-700 mb-2">
                <span>Min: $<span id="min-val">0</span></span>
                <span>Max: $<span id="max-val">1000</span></span>
            </div>
            <div class="relative h-10">
                <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-300 rounded transform -translate-y-1/2"></div>
                <div id="slider-track" class="absolute top-1/2 h-1 bg-blue-500 rounded transform -translate-y-1/2 z-10"></div>
                <input id="min-range" type="range" min="0" max="1000" value="{{ request('min_price', 10) }}" step="10"
                    class="absolute w-full pointer-events-none appearance-none z-20 bg-transparent slider-thumb">
                <input id="max-range" type="range" min="0" max="1000" value="{{ request('max_price', 1000) }}" step="10"
                    class="absolute w-full pointer-events-none appearance-none z-20 bg-transparent slider-thumb">

                <input type="hidden" name="min_price" id="min-price-input" value="{{ request('min_price', 10) }}">
                <input type="hidden" name="max_price" id="max-price-input" value="{{ request('max_price', 1000) }}">
            </div>
            <div class="flex items-center gap-2 mt-4">
            <input 
                type="number" 
                placeholder="0" 
                class="w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-400" 
                name="min_price_manual"
            />
            <span class="text-gray-500 text-sm">to</span>
            <input 
                type="number" 
                placeholder="1000" 
                class="w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-400" 
                name="max_price_manual"
            />
            </div>
        </div>
    </form>
    </div>
</div>

<div class="flex-1">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
            <div class="text-sm text-gray-500">{{ $products->count() }} items</div>

            <form action="{{ route('shop') }}" method="GET" class="relative w-full sm:w-64">
                @if(request('limit')) <input type="hidden" name="limit" value="{{ request('limit') }}"> @endif
                @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search products..." 
                    class="w-full pl-10 pr-4 py-2 rounded border border-gray-300 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <i class='bx bx-search absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500 text-lg'></i>
            </form>
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

    {{-- Pagination (top) --}}
    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-1">
            {{ $products->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    @endif
</div>


    <div>
        <select name="sort" onchange="this.form.submit()" class="p-2 border rounded text-sm">
            <option value="">Default</option>
            <option value="low_high" {{ request('sort') == 'low_high' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="high_low" {{ request('sort') == 'high_low' ? 'selected' : '' }}>Price: High to Low</option>
            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
        </select>
    </div>
    
</form>
</div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
        <a href="{{ route('product.details', $product->id) }}" class="relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col group w-full">
            <div class="absolute top-2 right-2 z-10">
                <i class='bx bx-heart text-gray-400 text-2xl hover:text-red-500 transition'></i>
            </div>

            @if($product->is_on_sale)
            <div class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                On Sale
            </div>
            @endif

            <div class="bg-white w-full h-60 flex items-center justify-center overflow-hidden">
                @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="object-contain w-full h-full">
                @else
                <span class="text-gray-400">No Image</span>
                @endif
            </div>

            <div class="p-5 flex flex-col flex-grow">
                <h3 class="font-semibold text-gray-800 h-12 overflow-hidden text-center" style="font-family: 'Open Sans', sans-serif; font-size:15px;">
                    {{ $product->name }}
                </h3>

                <div class="mt-auto text-center">
                    @if($product->is_on_sale)
                    <p class="text-gray-500 text-sm line-through">${{ number_format($product->price, 2) }}</p>
                    <p class="text-red-600 text-lg font-bold underline">${{ number_format($product->sale_price, 2) }}</p>
                    @else
                    <p class="text-red-600 text-lg font-bold">${{ number_format($product->price, 2) }}</p>
                    @endif
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="cart-form">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit"
                            class="mt-2 w-full bg-gray-100 text-gray-800 text-sm font-medium py-2 rounded hover:bg-gray-200 transition add-to-cart"
                            data-product-id="{{ $product->id }}" data-quantity="1">
                            Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>


<script>
    const minRange = document.getElementById('min-range');
    const maxRange = document.getElementById('max-range');
    const minVal = document.getElementById('min-val');
    const maxVal = document.getElementById('max-val');
    const sliderTrack = document.getElementById('slider-track');
    const minPriceInput = document.getElementById('min-price-input');
    const maxPriceInput = document.getElementById('max-price-input');
    const minInputBox = document.querySelector('input[name="min_price_manual"]');
    const maxInputBox = document.querySelector('input[name="max_price_manual"]');
    const form = document.getElementById('filter-form');

    // update the slider as the user will scroll 
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

        // update both the slider & the 2 inputs we have (the min and the max)
        minVal.textContent = min;
        maxVal.textContent = max;
        minPriceInput.value = min;
        maxPriceInput.value = max;

        minInputBox.value = min;
        maxInputBox.value = max;

        const percent1 = (min / 1000) * 100;
        const percent2 = (max / 1000) * 100;
        sliderTrack.style.left = percent1 + "%";
        sliderTrack.style.right = (100 - percent2) + "%";
    }

    // when the inputs change this updates the slider so it syncs with the input
    function updateSliderFromInput() {
        let min = parseInt(minInputBox.value) || 0;
        let max = parseInt(maxInputBox.value) || 1000;

        min = Math.max(0, Math.min(min, 1000));
        max = Math.max(0, Math.min(max, 1000));

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

        const percent1 = (min / 1000) * 100;
        const percent2 = (max / 1000) * 100;
        sliderTrack.style.left = percent1 + "%";
        sliderTrack.style.right = (100 - percent2) + "%";
    }

    let debounceTimerSlider;
    let debounceTimerInput;

    // time limit after the user uses the slider price range (0.5 seconds for now may increase in future)
    const debounceSubmitSlider = () => {
        clearTimeout(debounceTimerSlider);
        debounceTimerSlider = setTimeout(() => {
            form.submit();
        }, 500); 
    };
    // time limit after the user inputs the number in both min and max boxes (1.7 seconds)
    const debounceSubmitInput = () => {
        clearTimeout(debounceTimerInput);
        debounceTimerInput = setTimeout(() => {
            form.submit();
        }, 1700);
    };

    // All event listeners for sliders and the number input
    minRange.addEventListener('input', updateSlider);
    maxRange.addEventListener('input', updateSlider);

    minRange.addEventListener('change', debounceSubmitSlider);
    maxRange.addEventListener('change', debounceSubmitSlider);

    minInputBox.addEventListener('input', () => {
        updateSliderFromInput();
        debounceSubmitInput();
    });

    maxInputBox.addEventListener('input', () => {
        updateSliderFromInput();
        debounceSubmitInput();
    });
    updateSlider({ target: minRange });

    function toggleAllBrands(allCheckbox) {
        const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
        if (allCheckbox.checked) {
            brandCheckboxes.forEach(cb => cb.checked = false);
        }
    }

    document.querySelectorAll('.brand-checkbox').forEach(cb => {
        cb.addEventListener('change', () => {
            document.getElementById('brand-all').checked = false;
        });
    });

    document.querySelectorAll('input[name="category"]').forEach(input => {
        input.addEventListener('change', () => {
            form.submit();
        });
    });

    document.querySelectorAll('.brand-checkbox').forEach(cb => {
        cb.addEventListener('change', () => {
            document.getElementById('brand-all').checked = false;
            form.submit();
        });
    });

    document.getElementById('brand-all').addEventListener('change', () => {
        form.submit();
    });
</script>


@endsection
