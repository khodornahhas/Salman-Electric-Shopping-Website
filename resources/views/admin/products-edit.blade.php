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
            <label class="block font-semibold mb-1">Cost Price (Optional)</label>
            <input 
                type="number" 
                name="unit_price" 
                step="0.01" 
                value="{{ old('unit_price', $product->unit_price) }}" 
                class="w-full border rounded px-3 py-2"
            >
        </div>

        <div>
            <label class="block font-semibold mb-1">Selling Price</label>
            <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="w-full border rounded px-3 py-2"
        @if(!$product->contact_for_price && !$product->coming_soon) required @endif>
        </div>

        <div>
            <label class="block font-semibold mb-1">Discount Price (%)</label>
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
            <label class="inline-flex items-center mt-2">
                <input type="checkbox" name="coming_soon" id="coming_soon" value="1"
                    {{ old('coming_soon', $product->coming_soon ?? false) ? 'checked' : '' }}
                    class="mr-2">
                <span class="font-semibold">Coming Soon</span>
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
            <input id="quantity-input" type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mt-2">
            <label class="inline-flex items-center cursor-pointer select-none">
                <input
                    type="checkbox"
                    name="out_of_stock"
                    id="out-of-stock-checkbox"
                    class="form-checkbox h-5 w-5 text-red-600"
                    {{ old('out_of_stock', $product->out_of_stock) ? 'checked' : '' }}
                />
                <span class="ml-2 text-gray-700 font-semibold">Out of Stock</span>
            </label>
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
        <div>
            <label class="block font-semibold mb-1">Additional Images (max 4)</label>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full">
            <small class="text-gray-500">You can upload up to 4 images.</small>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
</div>

<script>
    function togglePriceInputs() {
        const contactCheckbox = document.querySelector('input[name="contact_for_price"]');
        const comingSoonCheckbox = document.querySelector('input[name="coming_soon"]');
        
        const disablePrice = contactCheckbox.checked && !comingSoonCheckbox.checked;

        document.querySelector('input[name="price"]').disabled = disablePrice;
        document.querySelector('input[name="sale_price"]').disabled = disablePrice;
        
        if (disablePrice) {
            document.querySelector('input[name="price"]').value = '';
            document.querySelector('input[name="sale_price"]').value = '';
        }
    }

    function toggleQuantity() {
        const outOfStockCheckbox = document.getElementById('out-of-stock-checkbox');
        const quantityInput = document.getElementById('quantity-input');

        if (outOfStockCheckbox.checked) {
            quantityInput.disabled = true;
            quantityInput.value = 0;
        } else {
            quantityInput.disabled = false;
            if (quantityInput.value == 0) quantityInput.value = 1;
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const contactCheckbox = document.querySelector('input[name="contact_for_price"]');
        const comingSoonCheckbox = document.querySelector('input[name="coming_soon"]');
        const outOfStockCheckbox = document.getElementById('out-of-stock-checkbox');

        togglePriceInputs();
        toggleQuantity();

        contactCheckbox.addEventListener('change', togglePriceInputs);
        comingSoonCheckbox.addEventListener('change', togglePriceInputs);
        outOfStockCheckbox.addEventListener('change', toggleQuantity);
    });
</script>
@endsection
