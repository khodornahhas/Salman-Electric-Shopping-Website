@extends('layouts.main')
@section('content')
<style>
  .animate-spin {
    animation: spin 1s linear infinite;
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }
    to {
      transform: rotate(360deg);
    }
  }
</style>
<div class="flex justify-center items-center min-h-screen bg-gray-50 p-4">
  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg transform transition duration-500 ease-in-out hover:scale-[1.02]">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b-2 border-blue-600 pb-2">
      Confirm Your Order
    </h2>

    <div class="space-y-4 mb-6">
      <p class="flex items-center space-x-2 text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 015 16v-2a4 4 0 014-4h6a4 4 0 014 4v2a4 4 0 01-1.121 2.804M15 11V7a4 4 0 10-8 0v4" />
        </svg>
        <strong>Name:</strong> <span class="ml-1 font-medium text-gray-900">{{ $data['first_name'] }} {{ $data['last_name'] ?? '' }}</span>
      </p>
      <p class="flex items-center space-x-2 text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12h2a2 2 0 012 2v4a2 2 0 01-2 2h-2m-4-6h.01M12 14v2m0-4v-2m0 0a6 6 0 106 6 6 6 0 00-6-6z" />
        </svg>
        <strong>Email:</strong> <span class="ml-1 font-medium text-gray-900">{{ $data['email'] }}</span>
      </p>
      <p class="flex items-center space-x-2 text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2M7 8h8v8H7z" />
        </svg>
        <strong>Phone:</strong> <span class="ml-1 font-medium text-gray-900">{{ $data['phone'] }}</span>
      </p>
      <p class="flex items-center space-x-2 text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a5 5 0 00-10 0v2h5zm-6 0v-2a5 5 0 00-10 0v2h5z" />
        </svg>
        <strong>Address:</strong> 
        <span class="ml-1 font-medium text-gray-900">{{ $data['street'] }}, {{ $data['apartment'] }}, {{ $data['city'] }}</span>
      </p>
      <p class="flex items-center space-x-2 text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 2H7a2 2 0 01-2-2v-5a2 2 0 012-2h10a2 2 0 012 2v5a2 2 0 01-2 2z" />
        </svg>
        <strong>Notes:</strong> <span class="ml-1 font-medium text-gray-900">{{ $data['notes'] ?? 'None' }}</span>
      </p>
    </div>

    <form action="{{ url('/cart/place-order') }}" method="POST" class="flex space-x-4" id="orderForm">
      @csrf
      @foreach ($data as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
      @endforeach

      <button type="submit" id="submitButton" class="flex items-center justify-center space-x-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 min-w-[120px]">
        <span id="buttonText" class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
          <span>Place Order</span>
        </span>
        <span id="loadingSpinner" class="hidden items-center space-x-2">
          <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>Processing...</span>
        </span>
      </button>

      <a href="{{ url('/cart/checkout') }}" class="flex items-center justify-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">Cancel</a>
    </form>
  </div>
</div>

<script>
  document.getElementById('orderForm').addEventListener('submit', function(e) {
    document.getElementById('buttonText').classList.add('hidden');
    document.getElementById('loadingSpinner').classList.remove('hidden');
    
    document.getElementById('submitButton').disabled = true;
    });
</script>
@endsection