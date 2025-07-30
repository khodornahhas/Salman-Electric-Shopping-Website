@extends('layouts.main')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
<div class="bg-blue-600 text-white font-bold py-4 pl-32 text-left mb-6" style="margin-top: 40px;margin-bottom:50px; font-size: 20px; font-family: 'Open Sans', sans-serif;">
    <div class="flex items-center space-x-4">
        <a href="{{ url('/home') }}" class="hover:underline opacity-40">Home</a>
        <span class="opacity-40">&gt;</span>
        <span class="opacity-100">Cart</span>
    </div>
</div>

<div class="flex items-center justify-center my-6 space-x-6">
 <div class="flex items-center space-x-2">
  <div class="flex items-center justify-center w-8 h-8 bg-blue-800 rounded-full">
    <i class='bx bx-check text-white text-xl'></i>
  </div>
  <span class="text-blue-800 font-medium">Cart</span>
</div>

  <span class="text-gray-400">›</span>

  <div class="flex items-center space-x-2">
    <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-800 rounded-full">2</div>
    <span class="text-gray-500">Checkout</span>
  </div>

  <span class="text-gray-400">›</span>

  <div class="flex items-center space-x-2">
    <div class="flex items-center justify-center w-8 h-8 border border-blue-300 text-blue-800 rounded-full bg-white">3</div>
    <span class="text-gray-500">Order</span>
  </div>
</div>

<div style="border-bottom: 1px solid lightgrey; width: 100%;"></div>

<div class="container mx-auto max-w-5xl py-12 px-4" style="font-family: 'Open Sans', sans-serif;">
    <form action="{{ url('/cart/confirm') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 gap-8 bg-white p-6 rounded-lg shadow-md">
            @php
                $user = auth()->user();
            @endphp

            <div>
                <h2 class="mb-6" style="font-size:30px;">Billing & Shipping</h2>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input type="text" name="first_name" placeholder="First name *" class="border p-2 w-full rounded" required value="{{ old('first_name', $user->first_name ?? '') }}">
                    <input type="text" name="last_name" placeholder="Last name (Optional)" class="border p-2 w-full rounded" value="{{ old('last_name', $user->last_name ?? '') }}">
                </div>

                <div class="mb-4 font-semibold">Country / Region <br> <span class="text-gray-600">Lebanon</span></div>

                <input type="text" name="street" placeholder="Street address (Optional)" class="border p-2 w-full mb-4 rounded" value="{{ old('street') }}">
                <input type="text" name="apartment" placeholder="Apartment, suite, unit, etc. (Optional)" class="border p-2 w-full mb-4 rounded" value="{{ old('apartment') }}">
                <input type="text" name="city" placeholder="Town / City (Optional)" class="border p-2 w-full mb-4 rounded" value="{{ old('city') }}">
                <input type="text" name="phone" placeholder="Phone *" class="border p-2 w-full mb-4 rounded" required value="{{ old('phone', $user->phone ?? '') }}">
                <input type="email" name="email" placeholder="Email *" class="border p-2 w-full mb-4 rounded" required value="{{ old('email', $user->email ?? '') }}">

                <div class="mb-4">
                    <label for="notes" class="block mb-2 font-semibold">Additional Information (Optional)</label>
                    <textarea name="notes" id="notes" rows="4" placeholder="Notes about your order, e.g. special delivery instructions." class="border p-2 w-full rounded">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div>
                <h2 class="mb-6" style="font-size:30px;">Your order</h2>
                <div class="border p-4 bg-gray-50 rounded-md">
                    <div class="flex justify-between font-semibold mb-2">
                        <span>Product</span>
                        <span>Price</span>
                    </div>

                    @foreach($cart as $item)
                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <span class="font-medium">{{ $item->name ?? $item->product->name }}</span>
                                <div class="text-sm text-gray-500">× {{ $item->quantity }}</div>
                            </div>
                            <div>${{ number_format($item->price ?? $item->product->price, 2) }}</div>
                        </div>
                    @endforeach

                    <div class="flex justify-between border-t pt-2 mt-2">
                        <span>Subtotal</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>

                    <div class="mt-4">
                        <p class="font-semibold mb-3">Shipping</p>
                        <label class="block">
                            <input type="radio" name="shipping" value="5.00" checked>
                            Outside Beirut/2–3 days for delivery: 
                        </label>
                        <label class="block mt-2">
                            <input type="radio" name="shipping" value="4.00">
                            Inside Beirut/same day delivery:
                        </label>
                        <label class="block mt-2">
                            <input type="radio" name="shipping" value="0.00">
                            Pick up from store
                        </label>
                    </div>

                    <div class="flex justify-between font-bold mt-4">
                        <span>Total</span>
                        <span id="order-total">${{ number_format($subtotal + 5, 2) }}</span>
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="w-full mt-4 bg-blue-600 text-white py-2 rounded-md">Continue to Confirmation</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
