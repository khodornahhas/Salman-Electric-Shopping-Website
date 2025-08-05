@extends('layouts.admin')
@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-6">Edit Product</h2>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ $product->description }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Information</label>
            <textarea name="information" class="w-full border rounded px-3 py-2" rows="4" placeholder="Additional product info...">{{ $product->information }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Sale Price</label>
            <input type="number" name="sale_price" step="0.01" value="{{ $product->sale_price }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Is On Sale</label>
            <input type="checkbox" name="is_on_sale" value="1" {{ old('is_on_sale', $product->is_on_sale ?? false) ? 'checked' : '' }}>
        </div>

        <div>
            <label class="block font-semibold mb-1">Is Featured</label>
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
        </div>

        <div>
            <label class="block font-semibold mb-1">Is Latest</label>
            <input type="checkbox" name="is_latest" value="1" {{ old('is_latest', $product->is_latest ?? false) ? 'checked' : '' }}>
        </div>


        <div>
            <label class="block font-semibold mb-1">Quantity</label>
            <input type="number" name="quantity" value="{{ $product->quantity }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Brand</label>
            <select name="brand_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Select Brand --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Image</label>
            <input type="file" name="image" class="w-full">
        </div>

        <div class="flex items-center">
            <input type="checkbox" name="is_available" id="is_available" {{ $product->is_available ? 'checked' : '' }} class="mr-2">
            <label for="is_available" class="font-semibold">Available?</label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
</div>
@endsection
