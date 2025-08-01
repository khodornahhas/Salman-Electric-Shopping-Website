@extends('layouts.main')

@section('content')
<div class="py-16 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-7xl bg-white rounded-lg p-6 shadow">
        <h2 class="text-2xl font-semibold mb-6 text-center">My Wishlist</h2>

        @if($wishlists->isEmpty())
            <p class="text-center text-gray-600">No items in your wishlist.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($wishlists as $wishlist)
                    @php
                        $product = isset($wishlist->product) ? $wishlist->product : $wishlist;
                    @endphp

                        <a href="{{ route('product.details', $product->id) }}" class="relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col group mx-auto w-64 sm:w-72 md:w-80">
                        <form method="POST" action="{{ route('wishlist.remove', $product->id) }}" class="absolute top-2 right-2 z-10">
                            @csrf
                            <button type="submit">
                                <i class='bx bxs-heart text-red-500 text-2xl hover:text-gray-400 transition'></i>
                            </button>
                        </form>

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
                                        class="mt-2 w-44 bg-gray-100 font-medium py-2 rounded hover:bg-gray-200 transition add-to-cart"
                                        data-product-id="{{ $product->id }}" data-quantity="1" style="font-size:18px; color:grey;">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a>

                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

