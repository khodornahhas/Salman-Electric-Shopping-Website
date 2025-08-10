@extends('layouts.admin')
@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-6">Edit Product</h2>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
            <label class="block font-semibold mb-1">Unit Price (Optional)</label>
            <input 
                type="number" 
                name="unit_price" 
                step="0.01" 
                value="{{ old('unit_price', $product->unit_price) }}" 
                class="w-full border rounded px-3 py-2"
            >
        </div>

        <div>
            <label class="block font-semibold mb-1">Price</label>
            <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="w-full border rounded px-3 py-2"
        @if(!$product->contact_for_price) required @endif>
            </div>

            <div>
                <label class="block font-semibold mb-1">Sale Price</label>
                <input type="number" name="sale_price" step="0.01" value="{{ $product->sale_price }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
            <label class="inline-flex items-center mt-2">
                <input type="checkbox" name="contact_for_price" id="contact_for_price" value="1"
                    {{ old('contact_for_price', $product->contact_for_price ?? false) ? 'checked' : '' }}
                    class="mr-2">
                <span class="font-semibold">Contact for Price</span>
            </label>
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
            
            @if($product->image)
                <p class="mt-2">Current Image:</p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-40 h-auto border rounded mt-1">
            @endif
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
</div>
<script>
function togglePriceInputs(checkbox) {
    document.querySelector('input[name="price"]').disabled = checkbox.checked;
    document.querySelector('input[name="sale_price"]').disabled = checkbox.checked;
}

document.addEventListener('DOMContentLoaded', () => {
    const contactCheckbox = document.querySelector('input[name="contact_for_price"]');
    togglePriceInputs(contactCheckbox);

    contactCheckbox.addEventListener('change', (e) => {
        togglePriceInputs(e.target);
    });
});
</script>

@endsection
