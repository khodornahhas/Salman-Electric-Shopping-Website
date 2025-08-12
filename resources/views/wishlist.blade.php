@extends('layouts.main')
@section('content')
<div class="bg-blue-600 text-white font-bold py-4 px-4 md:pl-32 text-left mb-6 text-[20px]" style="margin-top: 40px; font-family: 'Open Sans', sans-serif;">
    <div class="flex items-center space-x-4">
        <a href="{{ url('/home') }}" class="hover:underline opacity-40">Home</a>
        <span class="opacity-40">&gt;</span>
        <span class="opacity-100">Wishlist</span>
    </div>
</div>
<div class="pt-6 mb-20 sm:mb-40 md:mb-80 flex justify-center">
    <div class="w-full max-w-7xl p-4 sm:p-6"> 
        <h2 class="text-2xl font-semibold mb-14 text-center">My Wishlist</h2>

        @if($wishlists->isEmpty())
            <p class="text-center text-gray-600 mb-6">No items in your wishlist.</p>
            <div class="flex justify-center">
                <a href="{{ route('shop') }}" 
                   class="px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-full shadow-sm hover:bg-gray-300 transition-all duration-300 ease-in-out transform hover:scale-105">
                    Shop Now
                </a>
            </div>
        @else
        <div class="grid gap-6 justify-center mx-auto grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 max-w-7xl px-4 sm:px-6">
        @foreach($wishlists as $wishlist)
            @php
                $product = isset($wishlist->product) ? $wishlist->product : $wishlist;
            @endphp
            <a href="{{ route('product.details', $product->id) }}" class="relative bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow border border-gray-100 flex flex-col group mx-auto" style="max-width: none;">

                <form method="POST" action="{{ route('wishlist.remove', $product->id) }}" class="absolute top-2 right-2 z-10">
                    @csrf
                    <button type="submit">
                        <i class='bx bxs-heart text-red-500 text-2xl hover:text-gray-400 transition'></i>
                    </button>
                </form>

                @if($product->coming_soon)
                    <div class="absolute top-2 left-2 z-10 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
                        Coming Soon
                    </div>
                @elseif($product->sale_price && $product->sale_price < $product->price)
                    <div class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">On Sale</div>
                @endif

                <div class="bg-white w-full h-40 sm:h-48 flex items-center justify-center overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-contain max-h-full max-w-full">
                    @else
                        <span class="text-gray-400">No Image</span>
                    @endif
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-semibold text-gray-800 text-center mb-2 leading-tight" style="font-family: 'Open Sans', sans-serif; font-size:15px;">
                        {{ $product->name }}
                    </h3>

                    <div class="mt-auto text-center">
                        @if($product->coming_soon)
                            <p class="text-yellow-600 text-lg font-bold italic">Coming Soon</p>
                            <p class="text-sm text-gray-500 italic">Product will be available soon.</p>
                        @elseif($product->contact_for_price)
                            <p class="text-blue-600 text-lg font-bold italic">Contact for Price</p>
                            <p class="text-sm text-gray-500 italic">Please reach out for pricing</p>
                        @elseif($product->quantity == 0 || $product->out_of_stock)
                            <p class="text-red-600 text-lg font-bold italic mb-2">Out of Stock</p>
                        @elseif($product->sale_price && $product->sale_price < $product->price)
                            <p class="text-gray-500 text-sm line-through">${{ number_format($product->price, 2) }}</p>
                            <p class="text-red-600 text-lg font-bold underline">${{ number_format($product->sale_price, 2) }}</p>
                        @else
                            <p class="text-red-600 text-lg font-bold">${{ number_format($product->price, 2) }}</p>
                        @endif

                        @if(!$product->contact_for_price && !$product->coming_soon)
                            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="cart-form flex justify-center">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    @if($product->quantity == 0 || $product->out_of_stock) disabled class="mt-2 px-4 py-2 bg-gray-100 font-medium rounded cursor-not-allowed opacity-50" style="font-size:16px; color:grey;"
                                    @else class="mt-2 px-4 py-2 bg-gray-100 font-medium rounded hover:bg-gray-200 transition add-to-cart" style="font-size:16px; color:grey;" @endif
                                    data-product-id="{{ $product->id }}" data-quantity="1">
                                    Add to Cart
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
            </div>
        @endif
    </div>
</div>
@endsection


