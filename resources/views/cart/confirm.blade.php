@extends('layouts.main')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">Confirm Your Order</h2>

        <div class="mb-4">
            <p><strong>Name:</strong> {{ $data['first_name'] }} {{ $data['last_name'] ?? '' }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
            <p><strong>Address:</strong> {{ $data['street'] }}, {{ $data['apartment'] }}, {{ $data['city'] }}</p>
            <p><strong>Notes:</strong> {{ $data['notes'] ?? 'None' }}</p>
        </div>

        <form action="{{ url('/cart/place-order') }}" method="POST">
            @csrf
            @foreach ($data as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mr-2">Place Order</button>
            <a href="{{ url('/cart/checkout') }}" class="bg-red-500 text-white px-4 py-3 rounded">Cancel</a>
        </form>
    </div>
</div>
@endsection
