@extends('layouts.main')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<style>
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

    .cart-header {
        display: flex;
        background: #dbeafe;
        color: black;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 8px 8px 0 0;
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

    .cart-item {
        display: flex;
        background: white;
        padding: 16px 20px;
        margin-bottom: 10px;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        align-items: center;
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
<div class="bg-blue-600 text-white font-bold py-4 pl-32 text-left mb-6" style="margin-top: 40px;margin-bottom:50px; font-size: 20px; font-family: 'Open Sans', sans-serif;">
    <div class="flex items-center space-x-4">
        <a href="{{ url('/home') }}" class="hover:underline opacity-40">Home</a>
        <span class="opacity-40">&gt;</span>
        <span class="opacity-100">Cart</span>
    </div>
</div>

<div class="flex items-center justify-center my-6 space-x-6">
  <div class="flex items-center space-x-2">
    <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-800 rounded-full">1</div>
    <span class="text-blue-800 font-medium">Cart</span>
  </div>

  <span class="text-gray-400">›</span>

  <div class="flex items-center space-x-2">
    <div class="flex items-center justify-center w-8 h-8 border border-blue-300 text-blue-800 rounded-full bg-white">2</div>
    <span class="text-gray-500">Checkout</span>
  </div>

  <span class="text-gray-400">›</span>

  <div class="flex items-center space-x-2">
    <div class="flex items-center justify-center w-8 h-8 border border-blue-300 text-blue-800 rounded-full bg-white">3</div>
    <span class="text-gray-500">Order</span>
  </div>
</div>

<div class="cart-container" style="font-family: 'Open Sans', sans-serif;">
    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid grey; width: 100%; margin-bottom: 20px;">
    <h3 style="margin: 0;">Your Cart</h3>
    <i class='bx bx-cart' style="font-size: 24px;"></i>
    </div>    
    <div class="cart-layout">
        <div class="cart-items-section">
            <div class="cart-header">
                <div class="product-header">Product</div>
                <div class="qty-header">QTY</div>
                <div class="price-header">Price</div>
                <div class="delete-header"></div> 
            </div>

            @forelse($cartItems as $item)
            <div class="cart-item">
                <div class="product-info">
                    <img src="{{ asset($item->product->image) }}" class="product-image" alt="">
                    <div>
                        <p class="product-name">{{ $item->product->name }}</p>
                    </div>
                </div>

                <div class="quantity-controls">
                    <button class="quantity-btn" onclick="updateQuantity({{ $item->product->id }}, -1)">-</button>
                    <span class="quantity-value" id="qty-{{ $item->product->id }}">{{ $item->quantity }}</span>
                    <button class="quantity-btn" onclick="updateQuantity({{ $item->product->id }}, 1)">+</button>
                </div>

                <div class="product-price">
                    ${{ number_format($item->product->price, 2) }}
                </div>


                <div class="delete-icon">
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

        <div class="summary-section">
            <h2 class="summary-title">Order Summary</h2>

            @php
                $total = 0;
                foreach($cartItems as $item) {
                    $total += $item->product->price * $item->quantity;
                }
            @endphp

            <div class="summary-details">
                <div class="summary-row total-row">
                    <span>Total</span>
                    <span class="product-subtotal" id="subtotal-{{ $item->product->id }}"> ${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                </div>
            </div>

            <div class="summary-actions">
                <a href="#" class="checkout-btn">Checkout Now</a>
                <a href="{{ route('shop') }}" class="continue-btn">Continue Shopping</a>
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
                } else {
                    document.getElementById(`qty-${productId}`).innerText = data.quantity;
                    document.getElementById(`subtotal-${productId}`).innerText = `$${data.price}`;
                }
                updateCartTotal();
            }
        });

        function updateCartTotal() {
        fetch('/cart/total')
            .then(res => res.json())
            .then(data => {
                document.getElementById('cart-total').innerText = `$${data.total}`;
            });
        }
    }
</script>

@endsection
