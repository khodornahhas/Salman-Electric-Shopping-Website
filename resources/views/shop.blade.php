@extends('layouts.main')

@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
    input[type=range].slider-thumb::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    height: 1rem;
    width: 1rem;
    background-color: #3b82f6; 
    border-radius: 9999px;
    cursor: pointer;
    pointer-events: all;
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
        <span style="opacity: 0.4;">Home</span> <span style="opacity: 0.4;">&gt;</span> <span style="opacity: 0.4;">Shop</span>
    </div>

<div class="container mx-auto px-4 py-8">
    <div id="loading-spinner" class="flex justify-center items-center w-full h-full absolute bg-gray-100 bg-opacity-50 z-50" style="display: none;">
        <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
    </div>

    <div class="flex flex-col md:flex-row">
    <div class="w-full md:w-64 lg:w-72 xl:w-80 pr-0 md:pr-6 mb-6 md:mb-0">
    <div class="bg-white p-6 rounded-lg shadow-sm max-h-screen overflow-y-auto">
        <h2 class="text-xl font-bold mb-6">Filters</h2>

        <div class="mb-6">
            <h3 class="font-semibold mb-3">Price ($)</h3>
            <div class="flex justify-between text-sm text-gray-700 mb-2">
                <span>Min: $<span id="min-val">10</span></span>
                <span>Max: $<span id="max-val">1000</span></span>
            </div>

            <div class="relative h-10">
                <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-300 rounded transform -translate-y-1/2"></div>
                <div id="slider-track" class="absolute top-1/2 h-1 bg-blue-500 rounded transform -translate-y-1/2 z-10"></div>
                <input id="min-range" type="range" min="0" max="1000" value="10" step="10" class="absolute w-full pointer-events-none appearance-none z-20 bg-transparent slider-thumb">
                <input id="max-range" type="range" min="0" max="1000" value="1000" step="10" class="absolute w-full pointer-events-none appearance-none z-20 bg-transparent slider-thumb">
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold mb-3">Category</h3>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="checkbox" id="all-items" class="mr-2" checked>
                    <label for="all-items">All Items</label>
                </div>
                @foreach($categories as $category)
                <div class="flex items-center">
                    <input type="checkbox" id="cat-{{ $category->id }}" class="mr-2">
                    <label for="cat-{{ $category->id }}">{{ $category->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold mb-3">Brand</h3>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="checkbox" id="all-brands" class="mr-2" checked>
                    <label for="all-brands">All Brands</label>
                </div>
                @foreach($brands as $brand)
                <div class="flex items-center">
                    <input type="checkbox" id="brand-{{ $brand->id }}" class="mr-2">
                    <label for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


    <div class="flex-1">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
        <div class="text-sm text-gray-500">{{ $products->count() }} items</div>

        <div class="relative w-full sm:w-64">
            <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2 rounded border border-gray-300 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <i class='bx bx-search absolute top-1/2 left-3 transform -translate-y-1/2 text-gray-500 text-lg'></i>
        </div>
    </div>


        <div class="flex items-center gap-4">
            <div class="flex items-center gap-0 text-sm">
                <span class="text-gray-700 font-medium">Show:</span>
                <button class="px-2 py-1 rounded hover:bg-gray-200 transition text-gray-700">6</button>
                <button class="px-2 py-1 rounded hover:bg-gray-200 transition text-gray-700">12</button>
                <button class="px-2 py-1 rounded hover:bg-gray-200 transition text-gray-700">32</button>
                <button class="px-2 py-1 rounded hover:bg-gray-200 transition text-gray-700">All</button>
            </div>

            <select class="p-2 border rounded text-sm">
                <option>Default</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
                <option>Newest</option>
            </select>
        </div>
    </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($products as $product)
                <a href="#" class="relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col group w-full">
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
                        <h3 class="font-semibold text-gray-800 h-12 overflow-hidden text-center" style="font-family: 'Open Sans', sans-serif; font-size:15px;">{{ $product->name }}</h3>

                        <div class="mt-auto text-center">
                            @if($product->is_on_sale)
                            <p class="text-gray-500 text-sm line-through">${{ number_format($product->price, 2) }}</p>
                            <p class="text-red-600 text-lg font-bold underline">${{ number_format($product->sale_price, 2) }}</p>
                            @else
                            <p class="text-red-600 text-lg font-bold">${{ number_format($product->price, 2) }}</p>
                            @endif
                            <button class="mt-2 w-full bg-gray-100 text-gray-800 text-sm font-medium py-2 rounded hover:bg-gray-200 transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById("loading-spinner").style.display = "flex";
setTimeout(function() {

    document.getElementById("loading-spinner").style.display = "none";
}, 2000); 

const minRange = document.getElementById('min-range');
const maxRange = document.getElementById('max-range');
const minVal = document.getElementById('min-val');
const maxVal = document.getElementById('max-val');
const sliderTrack = document.getElementById('slider-track');

function updateSlider() {
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

    const percent1 = (min / 1000) * 100;
    const percent2 = (max / 1000) * 100;
    sliderTrack.style.left = percent1 + "%";
    sliderTrack.style.right = (100 - percent2) + "%";
}

minRange.addEventListener('input', updateSlider);
maxRange.addEventListener('input', updateSlider);

updateSlider(); 
</script>

@endsection
