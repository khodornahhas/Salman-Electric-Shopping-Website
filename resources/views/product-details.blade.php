@extends('layouts.main')

@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<div class="container mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row gap-10">
        
        <div class="w-full md:w-1/2 relative" style="margin-left:160px;">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-md" id="mainImage">
            <div class="absolute top-4 right-4 flex gap-3">
                <button class="text-2xl text-gray-600 hover:text-red-500">
                    <i class='bx bx-heart'></i>
                </button>
                <button class="text-2xl text-gray-600 hover:text-blue-600">
                    <i class='bx bx-cart'></i>
                </button>
                <button class="text-2xl text-gray-600 hover:text-green-600" onclick="openModal()">
                    <i class='bx bx-search-alt-2'></i>
                </button>
            </div>
        </div>

        <div class="w-full md:w-1/2">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>

            <div class="mb-2 text-sm text-gray-500">
                <span>Category: <strong>{{ $product->category->name ?? 'N/A' }}</strong></span> |
                <span>Brand: <strong>{{ $product->brand->name ?? 'N/A' }}</strong></span>
            </div>

            <div class="mb-4 text-xl font-semibold text-gray-700">
                @if($product->is_on_sale && $product->sale_price)
                    <span class="text-red-500">${{ $product->sale_price }}</span>
                    <span class="line-through text-gray-400 ml-2">${{ $product->price }}</span>
                @else
                    <span>${{ $product->price }}</span>
                @endif
            </div>

            <p class="text-gray-600 mb-6">{{ $product->description }}</p>
            <div class="flex items-center gap-4 mb-6">
                <label class="font-semibold text-gray-700">Quantity:</label>
                <div class="flex items-center border rounded px-3 py-1">
                    <button class="text-xl px-2 text-gray-700 hover:text-black">-</button>
                    <input type="text" value="1" class="w-10 text-center border-none focus:outline-none" readonly>
                    <button class="text-xl px-2 text-gray-700 hover:text-black">+</button>
                </div>
            </div>
            <button class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Add to Cart
            </button>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-xl font-bold mb-4">Product Information</h2>
        <p class="text-gray-600 leading-relaxed">
            {{ $product->description }}
        </p>
    </div>
</div>

<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
    <div class="relative max-w-3xl">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-white text-2xl">
            <i class='bx bx-x'></i>
        </button>
        <img src="{{ asset($product->image) }}" alt="Zoomed Image" class="rounded-lg max-h-[80vh] object-contain">
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>
@endsection
