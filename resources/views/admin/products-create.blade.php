@extends('layouts.admin')
@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-6">Create New Product</h2>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Sale Price</label>
            <input type="number" name="sale_price" step="0.01" class="w-full border rounded px-3 py-2">
        </div>

       <div>
        <label class="block font-semibold mb-1">Quantity (Optional)</label>
        <input type="number" name="quantity" class="w-full border rounded px-3 py-2" value="1" min="0">
        </div>
        
        <div>
            <label class="block font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>


        <div>
            <label class="block font-semibold mb-1">Brand</label>
            <select name="brand_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Select Brand --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Image</label>
            <input type="file" name="image" class="w-full">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_available" id="is_available" class="mr-2">
            <label for="is_available" class="font-semibold">Available?  (Optional)</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
    </form>
</div>
@endsection
