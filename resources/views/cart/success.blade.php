@extends('layouts.main')
@section('head')
    <title>Salman Electric - Confirmation</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
@endsection
@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-50 p-4">
  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg text-center">
    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
    </div>
    
    <h2 class="text-3xl font-bold text-gray-900 mb-4">Order Confirmed!</h2>
    
    <p class="text-gray-600 mb-8">
      Your order has been received successfully. We will contact you shortly.
    </p>
    
    <div class="bg-blue-50 p-6 rounded-lg text-left space-y-4">
      <div class="flex justify-between">
        <span class="text-gray-600">Order Number:</span>
        <span class="font-semibold text-blue-600">#{{ $order->id }}</span>
      </div>
      
      <div class="flex justify-between">
        <span class="text-gray-600">Date:</span>
        <span class="font-medium text-gray-900">{{ $order->created_at->format('M d, Y h:i A') }}</span>
      </div>
      
      <div class="flex justify-between">
        <span class="text-gray-600">Total Amount:</span>
        <span class="font-medium text-gray-900">${{ number_format($order->total, 2) }}</span>
      </div>
      
      <div class="flex justify-between">
        <span class="text-gray-600">Payment Method:</span>
        <span class="font-medium text-gray-900">Pickup from Store</span>
      </div>
    </div>
    
    <div class="mt-8">
      <a href="{{ url('/home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
        Back to Home
      </a>
    </div>
  </div>
</div>
@endsection