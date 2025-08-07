@extends('layouts.admin')
@section('content')
@if ($errors->any())
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 relative">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button onclick="this.parentElement.style.display='none';"class="absolute right-2 top-1 text-3xl font-bold leading-none focus:outline-none px-2"aria-label="Close">&times;
        </button>
    </div>
@endif

@if (session('error'))
    <div id="errorMessage" class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 relative">
        <span>{{ session('error') }}</span>
        <button onclick="document.getElementById('errorMessage').style.display='none';"class="absolute right-2 top-1 text-3xl font-bold leading-none focus:outline-none px-2"aria-label="Close">&times;</button>
    </div>
@endif

@if (session('success'))
    <div id="successMessage" class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 relative">
        <span>{{ session('success') }}</span>
        <button onclick="document.getElementById('successMessage').style.display='none';"class="absolute right-2 top-1 text-3xl font-bold leading-none focus:outline-none px-2"aria-label="Close">&times;</button>
    </div>
@endif


<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Manage Brands</h1>

    <form method="POST" action="{{ route('admin.brands.store') }}" class="mb-6">
        @csrf
        <div class="flex gap-4 items-end">
            <div>
                <label>Name</label>
                <input type="text" name="name" required class="border rounded px-2 py-1 w-full">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Brand</button>
            </div>
        </div>
    </form>

    <form id="editBrandForm" method="POST" class="hidden mb-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="editBrandId">
        <div class="flex gap-4 items-end">
            <div>
                <label>New Name</label>
                <input type="text" name="name" id="editBrandName" required class="border rounded px-2 py-1 w-full">
            </div>
            <div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update Brand</button>
            </div>
            <div>
                <button type="button" onclick="cancelEdit()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            </div>
        </div>
    </form>

    <table class="table-auto w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-20 py-3 text-left">ID</th>
                <th class="border px-20 py-3 text-left">Name</th>
                <th class="border px-20 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <tr>
                <td class="border px-20 py-3">{{ $loop->iteration }}</td> 
                <td class="border px-20 py-3">{{ $brand->name }}</td>
                <td class="border px-20 py-3 flex gap-2">
                    <button 
                        type="button"
                        class="bg-indigo-500 text-white px-3 py-2 rounded text-xs"
                        onclick="editBrand({{ $brand->id }}, '{{ addslashes($brand->name) }}')"
                    >
                        Edit
                    </button>

                    <form action="{{ route('admin.brands.delete', $brand->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-2 rounded text-xs">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function editBrand(id, name) {
        const form = document.getElementById('editBrandForm');
        form.classList.remove('hidden');
        form.action = `/admin/brands/${id}`;
        document.getElementById('editBrandId').value = id;
        document.getElementById('editBrandName').value = name;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function cancelEdit() {
        const form = document.getElementById('editBrandForm');
        form.classList.add('hidden');
        form.action = '';
        document.getElementById('editBrandId').value = '';
        document.getElementById('editBrandName').value = '';
    }
</script>
@endsection
