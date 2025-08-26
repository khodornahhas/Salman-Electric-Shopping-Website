@extends('layouts.main')
@section('head')
    <title>Salman Electric - Cart</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
@endsection
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
    * {
        font-family: 'Urbanist', sans-serif !important;
    }
    .delete-header {
        flex: 0.5;
    }

    .delete-icon {
        flex: 0.5;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cart-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .cart-layout {
        display: flex;
        gap: 20px;
    }

    .cart-items-section {
        flex: 2;
    }

    .summary-section {
        flex: 1;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: fit-content;
    }

    .cart-header,
    .cart-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 0.5fr;
        gap: 20px;
        align-items: center;
    }

    .product-header {
        flex: 2;
    }

    .qty-header {
        flex: 1;
        text-align: center;
    }

    .price-header {
        flex: 1;
        text-align: right;
    }

    .product-info {
        flex: 2;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .product-image {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 4px;
    }

    .product-name {
        font-weight: 500;
    }

    .quantity-controls {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .quantity-btn {
        width: 24px;
        height: 24px;
        background: #e5e7eb;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .quantity-value {
        width: 24px;
        color: #ef4444;
        text-align: center;
    }

    .product-price {
        flex: 1;
        text-align: right;
        font-weight: bold;
        color: black;
    }

    .empty-cart {
        padding: 16px;
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border-radius: 8px;
    }

    .summary-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .summary-details {
        margin-bottom: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .summary-divider {
        border: none;
        border-top: 1px solid #e5e7eb;
        margin: 12px 0;
    }

    .total-row {
        font-weight: 600;
    }

    .summary-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .checkout-btn {
        background: #dc2626;
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
    }

    .checkout-btn:hover {
        background: #b91c1c;
    }

    .continue-btn {
        background: #1e3a8a;
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
    }

    .continue-btn:hover {
        background: #1e40af;
    }

    @media (max-width: 768px) {
        .cart-layout {
            flex-direction: column;
        }
        
        .cart-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }
        
        .product-info {
            width: 100%;
        }
        
        .quantity-controls {
            width: 100%;
            justify-content: flex-start;
        }
        
        .product-price {
            width: 100%;
            text-align: left;
        }
    }
</style>
<div class="bg-blue-600 text-white font-bold py-4 px-4 md:pl-32 text-left mb-6 text-[20px]" style="margin-top: 40px; margin-bottom:50px; font-family: 'Open Sans', sans-serif;">
    <div class="flex items-center space-x-4">
        <a href="{{ url('/home') }}" class="hover:underline opacity-40">Home</a>
        <span class="opacity-40">&gt;</span>
        <span class="opacity-100">Cart</span>
    </div>
</div>

@if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded shadow-md flex items-center max-w-lg w-full z-50" role="alert">
        <span class="flex-1">{{ session('error') }}</span>
        <button 
            @click="show = false" 
            class="ml-4 text-red-700 hover:text-red-900 focus:outline-none"
            aria-label="Close"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

<div class="flex items-center justify-center my-6 space-x-2 flex-wrap text-sm sm:text-base">
    <div class="flex items-center space-x-2 mb-2 sm:mb-0">
        <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-800 rounded-full">1</div>
        <span class="text-blue-800 font-medium">Cart</span>
    </div>

    <span class="text-gray-400">›</span>
    
    <div class="flex items-center space-x-2 mb-2 sm:mb-0">
        <div class="flex items-center justify-center w-8 h-8 border border-blue-300 text-blue-800 rounded-full bg-white">2</div>
        <span class="text-gray-500">Checkout</span>
    </div>

    <span class="text-gray-400">›</span>

    <div class="flex items-center space-x-2 mb-2 sm:mb-0">
        <div class="flex items-center justify-center w-8 h-8 border border-blue-300 text-blue-800 rounded-full bg-white">3</div>
        <span class="text-gray-500">Order</span>
    </div>
</div>

<div class="cart-container px-4 md:px-20" style="font-family: 'Open Sans', sans-serif; margin-bottom:100px;">
    <div class="flex items-center justify-between border-b border-gray-400 w-full mb-6">
        <h3 class="m-0">Your Cart</h3>
        <i class='bx bx-cart text-xl'></i>
    </div>

    <div class="cart-layout flex flex-col lg:flex-row gap-8">
        <div class="cart-items-section w-full lg:w-2/3 overflow-x-auto">
            <div class="cart-header hidden sm:grid grid-cols-[2fr_1fr_1fr_0.5fr] gap-4 font-semibold border-b pb-2 mb-4 text-sm text-gray-600">
                <div class="product-header">Product</div>
                <div class="qty-header text-center">QTY</div>
                <div class="price-header text-center">Price</div>
                <div class="delete-header text-right"></div> 
            </div>

            @forelse($cartItems as $item)
                <div class="cart-item grid grid-cols-1 sm:grid-cols-4 gap-4 items-center mb-4 border-b pb-2" id="cart-item-{{ $item->product->id }}">
                    <div class="product-info flex items-center gap-4 sm:col-span-1">
                        @if($item->product && $item->product->image)
                            <a href="{{ route('product.details', $item->product->id) }}">
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="product-image w-20 h-20 object-cover">
                            </a>
                        @else
                            <p>No Image</p>
                        @endif
                        <div>
                            <p class="product-name">{{ $item->product->name }}</p>
                        </div>
                    </div>

                    <div class="quantity-controls flex items-center gap-2 sm:justify-center">
                        <button class="quantity-btn" onclick="updateQuantity({{ $item->product->id }}, -1)">-</button>
                        <span class="quantity-value" id="qty-{{ $item->product->id }}">
                            {{ $item->quantity ?? 1 }}
                        </span>
                        <button class="quantity-btn" onclick="updateQuantity({{ $item->product->id }}, 1)">+</button>
                    </div>

                    <div class="product-price sm:text-center">
                       @php
                            $displayPrice = $item->product->price;
                            $discountPercent = 0;
                            $user = Auth::user();

                        if(session('user_promo_code')) {
                            $promo = \App\Models\PromoCode::with('products')->find(session('user_promo_code'));
                            if($promo && $promo->products->contains($item->product->id)) {
                                $alreadyRedeemed = $user ? $promo->orders()->where('user_id', $user->id)->exists() : false;
                                if(!$alreadyRedeemed) {
                                    $discountPercent = $promo->discount_percent;
                                    $displayPrice = $item->product->price * (1 - $discountPercent / 100);
                                }
                            }
                        }

                        @endphp

                        @if($discountPercent > 0)
                            <span class="line-through text-gray-500 text-sm">
                                ${{ number_format($item->product->price, 2) }}
                            </span>
                            <br>
                            <span class="text-green-600 font-bold">
                                ${{ number_format($displayPrice, 2) }}
                            </span>
                            <p class="text-green-700 text-xs uppercase font-bold">
                                ({{ $discountPercent }}% off)
                            </p>
                        @else
                            ${{ number_format($displayPrice, 2) }}
                        @endif
                    </div>

                    <div class="delete-icon flex justify-end sm:justify-center">
                        <form method="POST" action="{{ route('cart.remove', $item->product->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Remove item">
                                <i class='bx bx-trash text-red-600 text-xl hover:text-red-800'></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="empty-cart">Your cart is empty.</p>
            @endforelse
        </div>

        <div class="summary-section w-full lg:w-1/3 border border-gray-200 p-4 rounded-md shadow-sm">
            <h2 class="summary-title text-lg font-semibold mb-4">Order Summary</h2>
                @php
                $total = 0;
                $user = Auth::user();
                $promo = session('user_promo_code') 
                    ? \App\Models\PromoCode::with('products')->find(session('user_promo_code')) 
                    : null;

                foreach ($cartItems as $item) {
                    $price = $item->product->price ?? 0;
                    $itemDiscount = 0;

                    if($item->product && $promo && $promo->products->contains($item->product->id)) {
                        $alreadyRedeemed = $user ? $promo->orders()->where('user_id', $user->id)->exists() : false;
                        if(!$alreadyRedeemed) {
                            $itemDiscount = $promo->discount_percent;
                            $total += $price * (1 - $itemDiscount / 100); 
                            if ($item->quantity > 1) {
                                $total += $price * ($item->quantity - 1); 
                            }
                            continue; 
                        }
                    }

                    $total += $price * $item->quantity;
                }
                @endphp

            <div class="summary-details">
                <div class="summary-row total-row flex justify-between font-bold text-gray-800 text-lg mb-4">
                    <span>Total</span>
                    <span id="cart-total">${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <div class="summary-actions flex flex-col gap-3">
                <a href="{{ route('cart.checkout') }}" class="checkout-btn text-center">Checkout Now</a>
                <a href="{{ route('shop') }}" class="continue-btn text-center">Continue Shopping</a>
            </div>
        </div>
    </div>
</div>


<script>
    function updateQuantity(productId, change) {
        fetch(`/cart/update/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ change: change })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.deleted) {
                    const item = document.getElementById(`cart-item-${productId}`);
                    if (item) item.remove();
                } 
                else {
                    document.getElementById(`qty-${productId}`).innerText = data.quantity;
                }
                updateCartTotal(); 
            }
        });
    }

    function updateCartTotal() {
        fetch('/cart/total')
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-total').innerText = `$${data.total}`;
            });
    }
</script>


@endsection
