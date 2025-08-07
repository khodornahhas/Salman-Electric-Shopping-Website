@extends('layouts.admin')

@section('content')
@if ($errors->any())
    <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 relative">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button 
            onclick="this.parentElement.style.display='none';"
            class="absolute right-2 top-1 text-3xl font-bold leading-none focus:outline-none px-2"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
@endif

@if (session('error'))
    <div id="errorMessage" class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 relative">
        <span>{{ session('error') }}</span>
        <button 
            onclick="document.getElementById('errorMessage').style.display='none';"
            class="absolute right-2 top-1 text-3xl font-bold leading-none focus:outline-none px-2"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
@endif

@if (session('success'))
    <div id="successMessage" class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 relative">
        <span>{{ session('success') }}</span>
        <button 
            onclick="document.getElementById('successMessage').style.display='none';"
            class="absolute right-2 top-1 text-3xl font-bold leading-none focus:outline-none px-2"
            aria-label="Close"
        >
            &times;
        </button>
    </div>
@endif

<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Manage Categories</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}" class="mb-6">
        @csrf
        <div class="flex gap-4 items-end">
            <div>
                <label>Name</label>
                <input type="text" name="name" required class="border rounded px-2 py-1 w-full">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Category</button>
            </div>
        </div>
    </form>

    <form id="editCategoryForm" method="POST" action="" class="hidden mb-6">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="editCategoryId">
        <div class="flex gap-4 items-end">
            <div>
                <label>New Name</label>
                <input type="text" name="name" id="editCategoryName" required class="border rounded px-2 py-1 w-full">
            </div>
            <div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update Category</button>
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
            @foreach($categories as $category)
            <tr>
                <td class="border px-20 py-3">{{ $category->id }}</td>
                <td class="border px-20 py-3">{{ $category->name }}</td>
                <td class="border px-20 py-3 flex gap-2">
                    <button 
                        type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-xs transition"
                        onclick="editCategory({{ $category->id }}, '{{ addslashes($category->name) }}')"
                    >
                        Edit
                    </button>

                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
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
    function editCategory(id, name) {
    document.getElementById('editCategoryForm').classList.remove('hidden');
    document.getElementById('editCategoryId').value = id;
    document.getElementById('editCategoryName').value = name;
    document.getElementById('editCategoryForm').action = `/admin/categories/${id}`;
    window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function cancelEdit() {
        document.getElementById('editCategoryForm').classList.add('hidden');
        document.getElementById('editCategoryId').value = '';
        document.getElementById('editCategoryName').value = '';
    }
</script>
@endsection
