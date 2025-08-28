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
            <label class="block font-semibold mb-1">Information</label>
            <textarea name="information" class="w-full border rounded px-3 py-2" rows="4" placeholder="Additional product info..."></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Cost Price (Optional)</label>
            <input type="number" name="unit_price" step="0.01" class="w-full border rounded px-3 py-2" value="{{ old('unit_price') }}">
        </div>

        <div>
            <label class="block font-semibold mb-1">Selling Price</label>
            <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Discount Price (%)</label>
            <input type="number" name="sale_price" step="0.01" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Contact for Price</label>
            <input type="checkbox" name="contact_for_price" value="1" {{ old('contact_for_price') ? 'checked' : '' }}>
        </div>

        <div>
            <label class="block font-semibold mb-1">Coming Soon</label>
            <input type="checkbox" name="coming_soon" value="1" {{ old('coming_soon') ? 'checked' : '' }}>
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
            <label class="block font-semibold mb-1">Quantity (Optional)</label>
            <input id="quantity-input" type="number" name="quantity" class="w-full border rounded px-3 py-2" value="1" min="0">
        </div>
        <div class="mt-2">
            <label class="inline-flex items-center cursor-pointer select-none">
                <input type="checkbox" name="out_of_stock" id="out-of-stock-checkbox" class="form-checkbox h-5 w-5 text-red-600" />
                <span class="ml-2 text-gray-700 font-semibold">Out of Stock</span>
            </label>
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
        
        <div>
            <label class="block font-semibold mb-1">Additional Images (max 4)</label>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full">
            <small class="text-gray-500">You can upload up to 4 images.</small>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Product</button>
    </form>
</div>
<script>
    function togglePriceInputs() {
        const contactCheckbox = document.querySelector('input[name="contact_for_price"]');
        const comingSoonCheckbox = document.querySelector('input[name="coming_soon"]');
        
        const disable = contactCheckbox.checked && !comingSoonCheckbox.checked;

        document.querySelector('input[name="price"]').disabled = disable;
        document.querySelector('input[name="sale_price"]').disabled = disable;
        
        if (disable) {
            document.querySelector('input[name="price"]').value = '';
            document.querySelector('input[name="sale_price"]').value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const contactCheckbox = document.querySelector('input[name="contact_for_price"]');
        const comingSoonCheckbox = document.querySelector('input[name="coming_soon"]');
        const outOfStockCheckbox = document.getElementById('out-of-stock-checkbox');
        const quantityInput = document.getElementById('quantity-input');

        togglePriceInputs();

        contactCheckbox.addEventListener('change', togglePriceInputs);
        comingSoonCheckbox.addEventListener('change', togglePriceInputs);

        function toggleQuantity() {
            if (outOfStockCheckbox.checked) {
                quantityInput.disabled = true;
                quantityInput.value = 0;
            } else {
                quantityInput.disabled = false;
                if (quantityInput.value == 0) quantityInput.value = 1;
            }
        }

        outOfStockCheckbox.addEventListener('change', toggleQuantity);

        toggleQuantity();
    });
</script>


@endsection
