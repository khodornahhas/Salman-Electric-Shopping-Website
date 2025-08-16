@extends('layouts.main')
@section('content')
<div class="container mx-auto py-10 px-4 max-w-6xl">
    <h1 class="text-3xl mb-8 text-gray-800">My Orders <i class='bx bx-cart' style="font-size: 24px;"></i><div class="w-full border-b border-gray-300"></div></h1>  
    @if($orders->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg mb-44">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p class="mt-4 text-lg text-gray-600">You haven't placed any orders yet.</p>
            <a href="{{ url('/shop') }}" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                Browse Products
            </a>
        </div>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                            <div class="mb-2 sm:mb-0">
                                <h2 class="text-lg font-semibold text-gray-800">Order #{{ $order->id }}</h2>
                                <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('F j, Y') }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'shipped') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="text-lg font-bold text-gray-800">Total: ${{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6">
                        <div class="space-y-4">
                            @foreach($order->orderItems as $item)
                                <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-lg transition duration-150">
                                <a href="{{ route('product.details', $item->product->id) }}">
                                <img src="{{ asset('storage/' . $item->product->image) }}" 
                                    alt="{{ $item->product->name }}" 
                                    class="w-20 h-20 object-cover rounded">
                                    </a>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-800">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-500 mt-1">Quantity: {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-gray-800">${{ number_format($item->price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
