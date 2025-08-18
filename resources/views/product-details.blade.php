@extends('layouts.main')

@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
    * {
        font-family: 'Urbanist', sans-serif !important;
    }
</style>
            <div class="bg-blue-600 text-white font-bold py-4 px-4 md:px-16 text-left mt-[30px]">
                <div class="max-w-7xl mx-auto">
                    <a href="{{ url('/home') }}" class="hover:underline opacity-70 transition-opacity duration-300">Home</a>
                    <span class="opacity-50 mx-2">&gt;</span>

                    @if($product->category)
                        <a href="{{ url('/shop/' . $product->category->slug . '/brands/all/min-price/0/max-price/2500') }}"
                        class="hover:underline opacity-70 transition-opacity duration-300">
                            {{ $product->category->name }}
                        </a>
                        <span class="opacity-50 mx-2">&gt;</span>
                    @endif

                    <span class="opacity-90">{{ $product->name }}</span>
                </div>
            </div>

            <div class="container mx-auto px-4 py-10">
                <div class="flex flex-col md:flex-row gap-10 items-center">
                    <div class="w-full md:w-1/2 flex justify-center">
                        <div class="relative w-full max-w-[600px]">
                            @if($product->coming_soon)
                                <div class="absolute top-2 left-2 z-10 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
                                    Coming Soon
                                </div>
                            @elseif($product->quantity == 0 || $product->out_of_stock)
                                <div class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                                    Out of Stock
                                </div>
                            @endif

                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-xl">

                            <div class="absolute top-4 right-4 flex gap-3">
                                <button class="text-xl bg-white rounded-full p-2 shadow hover:text-red-500 transition">
                                    <i class='bx bx-heart'></i>
                                </button>
                                <button class="text-xl bg-white rounded-full p-2 shadow hover:text-green-600 transition" onclick="openModal()">
                                    <i class='bx bx-search-alt-2'></i>
                                </button>
                            </div>
                        </div>
            </div>

        <div class="w-full md:w-1/2 space-y-8 mb-[130px] font-[Open Sans, sans-serif]">
            <h1 class="text-4xl font-bold text-gray-900">{{ $product->name }}</h1>
            <p class="text-lg text-gray-500 text-[20px]">{{ $product->description }}</p>

            <div class="text-gray-500 text-[20px]">
                <a href="{{ url('/shop/' . $product->category->slug . '/brands/all/min-price/0/max-price/2500') }}"
                class="hover:underline cursor-pointer">
                    Category: <span class="text-black">{{ $product->category->name ?? 'N/A' }}</span>
                </a>

                <span class="mx-2">|</span>
                <a href="{{ url('/shop/all/brands/' . $product->brand->slug . '/min-price/0/max-price/2500') }}"
                class="hover:underline cursor-pointer">
                    Brand: <span class="text-black">{{ $product->brand->name ?? 'N/A' }}</span>
                </a>
            </div>

            <div class="text-2xl font-semibold text-gray-800">
                @php
                    $discountPercent = 0;
                    $user = Auth::user();
                    if($user && session('user_promo_code')) {
                        $promo = \App\Models\PromoCode::with('products')->find(session('user_promo_code'));
                        if($promo 
                        && $promo->products->contains($product->id) 
                        && !$promo->users()->where('user_id', $user->id)->exists()) 
                        {
                            $discountPercent = $promo->discount_percent;
                        }
                    }
                @endphp

                @if($product->coming_soon)
                    <span class="text-yellow-600 text-[22px] font-semibold">Coming Soon</span>
                @elseif($product->contact_for_price)
                    <span class="text-blue-600 text-[22px] font-semibold">Contact for Price</span>
                @elseif($product->quantity == 0 || $product->out_of_stock)
                    <span class="text-red-600 text-[22px] font-semibold">Out of Stock</span>
                @elseif($discountPercent > 0)
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="line-through text-gray-400 text-xl">${{ number_format($product->price, 2) }}</span>
                        <span class="text-green-600 text-3xl">
                            ${{ number_format($product->price * (1 - $discountPercent/100), 2) }}
                        </span>
                        <span class="text-green-700 text-sm font-bold uppercase">
                            Special Price ({{ $discountPercent }}% off)
                        </span>
                    </div>
                @elseif($product->sale_price && $product->sale_price < $product->price)
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-red-500 text-3xl">${{ number_format($product->sale_price, 2) }}</span>
                        <span class="line-through text-gray-400 text-xl">${{ number_format($product->price, 2) }}</span>
                        <span class="text-red-600 text-sm font-bold uppercase">On Sale</span>
                    </div>
                @else
                    <span class="text-red-600 text-[35px]">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>


            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="cart-form">
                @csrf

                @if(!($product->quantity == 0 || $product->out_of_stock || $product->coming_soon || $product->contact_for_price))
                <div class="flex items-center gap-4 mb-4">
                    <label class="font-semibold text-gray-700">Quantity:</label>
                    <div class="flex items-center border rounded px-3 py-1">
                        <button type="button" id="decrease-qty" class="text-xl px-2 text-gray-700 hover:text-black">-</button>
                        <span id="display-qty" class="w-10 text-center select-none">1</span>
                        <button type="button" id="increase-qty" class="text-xl px-2 text-gray-700 hover:text-black">+</button>
                    </div>
                </div>
                <input type="hidden" name="quantity" id="hidden-qty" value="1">
                @endif

                <div class="flex flex-col sm:flex-row gap-3">
                    @if($product->coming_soon)
                        <button type="button" class="w-full sm:w-auto px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition text-[18px]">
                            Ask via WhatsApp
                        </button>
                    @elseif($product->contact_for_price)
                        <button disabled
                            class="w-full sm:w-auto px-6 py-3 bg-gray-300 text-gray-500 rounded cursor-not-allowed text-[18px]"
                            title="Contact for Price products cannot be added to cart">
                            Contact for Price
                        </button>
                    @elseif($product->quantity == 0 || $product->out_of_stock)
                        <button disabled
                            class="w-full sm:w-auto px-6 py-3 bg-gray-300 text-gray-500 rounded cursor-not-allowed text-[18px]"
                            title="Out of Stock">
                            Add to cart
                        </button>
                    @else
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition add-to-cart text-[18px]"
                            data-product-id="{{ $product->id }}">
                            Add to Cart
                        </button>
                    @endif

                        @if(!$product->coming_soon && !($product->quantity == 0 || $product->out_of_stock))
                        <button type="button" class="w-full sm:w-auto px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600 transition text-[18px]">
                            @if($product->contact_for_price)
                                Contact via WhatsApp
                            @else
                                Buy via WhatsApp
                            @endif
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<div class="w-full border-b border-gray-300 font-[Open Sans, sans-serif]">
    <div class="flex justify-center">
        <div class="relative">
            <span class="font-bold text-gray-800 pb-3 inline-block text-[18px]">
                Product Information
            </span>
            <div class="absolute bottom-0 left-0 w-full border-b-2 border-black"></div>
        </div>
    </div>
</div>

<div class="mt-6 font-[Open Sans, sans-serif]">
    <h1 class="font-bold mb-4 text-[32px] md:text-[45px] ml-4">About this product</h1>
    <p class="whitespace-pre-line text-gray-700 ml-4">{{ $product->information }}</p>
</div>

<div class="w-full border-b border-gray-300"></div>

@if($relatedProducts->count())
    <div class="mt-16 px-4 md:px-10 max-w-screen-xl mx-auto">
        <h2 class="mb-6 text-gray-800 text-[24px] md:text-[29px] font-[Open Sans, sans-serif]">You Might Also Like</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-5">
            @foreach($relatedProducts as $related)
                <div class="relative bg-white rounded-xl overflow-hidden shadow-sm transition border border-gray-100 flex flex-col h-[420px]">

                    <div class="absolute top-2 right-2 z-10 cursor-pointer add-to-wishlist"
                        data-product-id="{{ $related->id }}">
                        <i class='bx {{ in_array($related->id, $wishlistProductIds) ? "bxs-heart text-red-500" : "bx-heart text-gray-400" }} text-2xl hover:text-red-500 transition'></i>
                    </div>

                    @if($related->coming_soon)
                        <div class="absolute top-2 left-2 z-10 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
                            Coming Soon
                        </div>
                    @elseif($related->sale_price && $related->sale_price < $related->price)
                        <div class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                            On Sale
                        </div>
                    @endif

                    <a href="{{ route('product.details', $related->id) }}" class="w-full h-56 bg-white flex items-center justify-center overflow-hidden">
                        <img src="/storage/{{ $related->image }}"
                            alt="{{ $related->name }}"
                            class="w-full h-full object-contain transform transition-transform duration-300 hover:scale-105 cursor-pointer" />
                    </a>

                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="font-semibold text-gray-800 text-center leading-tight font-[Open Sans, sans-serif] text-[15px] min-h-[48px]">
                            {{ $related->name }}
                        </h3>

                       <div class="mt-auto text-center mb-0">
                            @php
                                $discountPercent = 0;
                                $user = Auth::user();
                                if($user && session('user_promo_code')) {
                                    $promo = \App\Models\PromoCode::with('products')->find(session('user_promo_code'));
                                    if($promo 
                                    && $promo->products->contains($related->id) 
                                    && !$promo->users()->where('user_id', $user->id)->exists()) 
                                    {
                                        $discountPercent = $promo->discount_percent;
                                    }
                                }
                            @endphp

                            @if($related->coming_soon)
                                <p class="text-yellow-600 text-lg font-bold italic">Coming Soon</p>
                                <p class="text-sm text-gray-500 italic">Stay tuned</p>
                            @elseif($related->contact_for_price)
                                <p class="text-red-600 text-lg font-bold italic">Contact for Price</p>
                                <p class="text-sm text-gray-500 italic">Please reach out for pricing</p>
                            @elseif($related->quantity == 0 || $related->out_of_stock)
                                <p class="text-red-600 text-lg font-bold italic mb-2">Out of Stock</p>
                                <button
                                    class="mt-2 w-44 bg-gray-100 font-medium py-2 rounded cursor-not-allowed opacity-50"
                                    disabled
                                >
                                    Add to Cart
                                </button>
                            @elseif($discountPercent > 0)
                                <p class="text-gray-500 text-sm line-through">${{ number_format($related->price, 2) }}</p>
                                <p class="text-green-600 text-lg font-bold underline">
                                    ${{ number_format($related->price * (1 - $discountPercent/100), 2) }}
                                </p>
                                <p class="text-green-700 text-sm font-bold uppercase">
                                    Special Price ({{ $discountPercent }}% off)
                                </p>
                                <button
                                    class="mt-2 w-44 bg-gray-100 font-medium py-2 rounded hover:bg-gray-200 transition add-to-cart"
                                >
                                    Add to Cart
                                </button>
                            @elseif($related->sale_price && $related->sale_price < $related->price)
                                <p class="text-gray-500 text-sm line-through">${{ number_format($related->price, 2) }}</p>
                                <p class="text-red-600 text-lg font-bold underline">${{ number_format($related->sale_price, 2) }}</p>
                                <button
                                    class="mt-2 w-44 bg-gray-100 font-medium py-2 rounded hover:bg-gray-200 transition add-to-cart"
                                >
                                    Add to Cart
                                </button>
                            @else
                                <p class="text-red-600 text-lg font-bold">${{ number_format($related->price, 2) }}</p>
                                <button
                                    class="mt-2 w-44 bg-gray-100 font-medium py-2 rounded hover:bg-gray-200 transition add-to-cart"
                                >
                                    Add to Cart
                                </button>
                            @endif
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

    document.addEventListener('DOMContentLoaded', function () {
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.add-to-wishlist').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            const productId = this.getAttribute('data-product-id');
            const icon = this.querySelector('i');

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
});
</script>
@endsection
