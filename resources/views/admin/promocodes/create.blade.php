@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Create Promo Code</h1>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded">
            <strong class="block mb-2">Whoops! There were some problems with your input:</strong>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.promocodes.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 space-y-5">
        @csrf

        <div>
            <label for="code" class="block text-gray-700 font-semibold mb-1">Promo Code <span class="text-gray-400">(leave blank to auto-generate)</span></label>
            <input type="text" name="code" id="code" maxlength="8" value="{{ old('code') }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <div>
            <label for="discount_percent" class="block text-gray-700 font-semibold mb-1">Discount Percent</label>
            <input type="number" name="discount_percent" id="discount_percent" min="1" max="100" value="{{ old('discount_percent') }}" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <div>
            <label for="expires_at" class="block text-gray-700 font-semibold mb-1">Expires At <span class="text-gray-400">(optional)</span></label>
            <input type="date" name="expires_at" id="expires_at" value="{{ old('expires_at') }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
        </div>

        <div>
            <label for="products" class="block text-gray-700 font-semibold mb-1">Select Products</label>
            <select name="products[]" id="products" multiple required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 h-40">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500 mt-1">Hold Ctrl (Windows) or Cmd (Mac) to select multiple.</p>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition-colors shadow">
                Create Promo Code
            </button>
        </div>
    </form>
</div>
@endsection
