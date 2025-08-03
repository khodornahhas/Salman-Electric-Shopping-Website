@extends('layouts.main')

@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

<div class="bg-blue-600 text-white font-bold py-4 pl-32 text-left mb-6" style="margin-top: 30px; font-size: 20px; font-family: 'Open Sans', sans-serif;">
    <div class="flex items-center space-x-4">
        <a href="{{ url('/home') }}" class="hover:underline opacity-40">Home</a>
        <span class="opacity-40">&gt;</span>

        @if($product->category)
            <a href="{{ route('shop', ['category' => $product->category->id, 'brands[]' => 'all', 'min_price' => 10, 'max_price' => 1000, 'min_price_manual' => 10, 'max_price_manual' => 1000]) }}"
               class="hover:underline opacity-40">
               {{ $product->category->name }}
            </a>
            <span class="opacity-40">&gt;</span>
        @endif

        <span class="opacity-100">{{ $product->name }}</span>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row gap-10 items-center">
        <div class="w-full md:w-1/2 flex justify-center">
            <div class="relative w-[600px]">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                     class="w-full rounded-lg shadow-xl">
                <div class="absolute top-4 right-4 flex gap-3">
                    <button class="text-xl bg-white rounded-full p-2 shadow hover:text-red-500 transition">
                        <i class='bx bx-heart'></i>
                    </button>
                    <button class="text-xl bg-white rounded-full p-2 shadow hover:text-green-600 transition"
                            onclick="openModal()">
                        <i class='bx bx-search-alt-2'></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 space-y-8" style="margin-bottom:130px; font-family: 'Open Sans', sans-serif;">
            <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
            <p class="text-lg text-gray-500" style="font-size:20px;">{{ $product->description }}</p>

            <div class="text-sm text-gray-500 space-x-2" style="font-size:20px;">
                <a href="{{ route('shop', ['category' => $product->category->id]) }}"
                class="text-black hover:underline cursor-pointer">
                    {{ $product->category->name ?? 'N/A' }}
                </a>

                <span>|</span>
                <a href="{{ route('shop', ['brands[]' => $product->brand->id]) }}"
                class="text-black hover:underline cursor-pointer">
                    {{ $product->brand->name ?? 'N/A' }}
                </a>
            </div>

            <div class="text-2xl font-semibold text-gray-800">
                @if($product->is_on_sale && $product->sale_price)
                    <span class="text-red-500">${{ $product->sale_price }}</span>
                    <span class="line-through text-gray-400 ml-2">${{ $product->price }}</span>
                @else
                    <span class="text-red-600" style="font-size:35px;">${{ $product->price }}</span>
                @endif
            </div>

            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="cart-form">
                @csrf
                <div class="flex items-center gap-4 mb-4">
                    <label class="font-semibold text-gray-700">Quantity:</label>
                    <div class="flex items-center border rounded px-3 py-1">
                        <button type="button" id="decrease-qty" class="text-xl px-2 text-gray-700 hover:text-black">-</button>
                        <span id="display-qty" class="w-10 text-center select-none">1</span>
                        <button type="button" id="increase-qty" class="text-xl px-2 text-gray-700 hover:text-black">+</button>
                    </div>
                </div>

                <input type="hidden" name="quantity" id="hidden-qty" value="1">

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition add-to-cart"
                        data-product-id="{{ $product->id }}" style="font-size:18px;">
                        Add to Cart
                    </button>
                    <button type="button" class="w-full sm:w-auto px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        Buy via WhatsApp
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="w-full border-b border-gray-300" style="font-family: 'Open Sans', sans-serif;">
    <div class="flex justify-center">
        <div class="relative">
            <span class="font-bold text-gray-800 pb-3 inline-block" style="font-size:18px;">
                Product Information
            </span>
            <div class="absolute bottom-0 left-0 w-full border-b-2 border-black"></div>
        </div>
    </div>
</div>

<div class="mt-6" style="font-family: 'Open Sans', sans-serif;">
    <h1 class="font-bold mb-4" style="font-size:45px;">About this product</h1>
    <p class="text-gray-600 leading-relaxed">
        {{ $product->information }}
    </p>
</div>

<div class="w-full border-b border-gray-300"></div>

@if($relatedProducts->count())
    <div class="mt-16 px-8 md:px-32">
        <h2 class="mb-6 text-gray-800" style="font-size: 29px; font-family: 'Open Sans', sans-serif;">You Might Also Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedProducts as $related)
                <div class="relative bg-white rounded-xl overflow-hidden shadow-sm transition border border-gray-100 flex flex-col h-[420px]">
                    
                    {{-- Wishlist Heart --}}
                    <div class="absolute top-2 right-2 z-10 cursor-pointer add-to-wishlist"
                        data-product-id="{{ $related->id }}">
                        <i class='bx {{ in_array($related->id, $wishlistProductIds) ? "bxs-heart text-red-500" : "bx-heart text-gray-400" }} text-2xl hover:text-red-500 transition'></i>
                    </div>

                    {{-- On Sale Badge --}}
                    @if($related->is_on_sale)
                    <div class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                        On Sale
                    </div>
                    @endif

                    {{-- Product Image --}}
                    <a href="{{ route('product.details', $related->id) }}" class="w-full h-56 bg-white flex items-center justify-center overflow-hidden">
                        <img src="{{ asset($related->image) }}"
                            alt="{{ $related->name }}"
                            class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105 cursor-pointer" />
                    </a>

                    {{-- Product Info --}}
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-semibold text-gray-800 text-center leading-tight"
                            style="font-family: 'Open Sans', sans-serif; font-size: 15px; min-height: 48px;">
                            {{ $related->name }}
                        </h3>

                        <div class="mt-auto text-center">
                            @if($related->is_on_sale && $related->sale_price)
                                <p class="text-gray-500 text-sm line-through">${{ number_format($related->price, 2) }}</p>
                                <p class="text-red-600 text-lg font-bold underline">${{ number_format($related->sale_price, 2) }}</p>
                            @else
                                <p class="text-red-600 text-lg font-bold">${{ number_format($related->price, 2) }}</p>
                            @endif

                            <button class="mt-2 w-full bg-gray-100 text-gray-800 text-sm font-medium py-2 rounded hover:bg-gray-200 transition">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

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

   document.addEventListener('DOMContentLoaded', function () {
    // Quantity buttons
    const decreaseBtn = document.getElementById('decrease-qty');
    const increaseBtn = document.getElementById('increase-qty');
    const displayQty = document.getElementById('display-qty');
    const hiddenQty = document.getElementById('hidden-qty');

    let quantity = parseInt(hiddenQty.value) || 1;

    decreaseBtn.addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            displayQty.textContent = quantity;
            hiddenQty.value = quantity;
        }
    });

    increaseBtn.addEventListener('click', () => {
        quantity++;
        displayQty.textContent = quantity;
        hiddenQty.value = quantity;
    });

    // Wishlist buttons
    document.querySelectorAll('.add-to-wishlist').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const productId = this.getAttribute('data-product-id');
            const icon = this.querySelector('i');

            fetch("{{ url('/wishlist/add') }}/" + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    icon.classList.remove('bx-heart', 'text-gray-400');
                    icon.classList.add('bxs-heart', 'text-red-500');
                } else {
                    alert('Failed to add to wishlist.');
                }
            })
            .catch(error => {
                alert('An error occurred.');
                console.error('Error:', error);
            });
        });
    });
});


</script>
@endsection
