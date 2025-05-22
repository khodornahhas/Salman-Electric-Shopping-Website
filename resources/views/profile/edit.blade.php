@extends('layouts.main')
@section('content')
<div class="space-y-20 px-6 md:px-24 lg:px-32" style="margin-top: 70px; margin-bottom: 70px;">
    <div class="bg-white shadow-lg rounded-xl p-8 md:p-10 border border-gray-200">
        <div class="mb-6 border-b pb-4 border-gray-300">
            <h2 class="text-2xl font-semibold text-[#467599]">Personal Details</h2>
            <p class="text-sm text-[#467599] mt-1">Edit your account's profile information</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2">
                <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}"
                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}"
                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" readonly
                    class="mt-2 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm opacity-60 cursor-not-allowed">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}"
                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}"
                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location', Auth::user()->location) }}"
                    class="mt-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
       
        </div>

        <div class="flex justify-end mt-10">
            <button type="submit"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                Update Profile
            </button>
        </div> 
    </form>
    </div>

    <div x-data="{ showModal: false }" class="bg-white shadow-lg rounded-xl p-8 md:p-10 border border-gray-200">
    <div class="mb-5 border-b pb-4 border-gray-300">
        <h2 class="text-xl font-semibold text-gray-800" style="color:#467599">Delete Account</h2>
        <p class="text-sm text-gray-600">
            Once your account is deleted, all of your saved data including bookings made will be permanently removed.
        </p>
    </div>

    <!-- Delete Button -->
    <button @click="showModal = true"
        class="px-5 py-2 bg-gradient-to-r from-red-600 to-red-800 text-white rounded-md font-semibold shadow hover:from-red-700 hover:to-red-900 transition">
        DELETE ACCOUNT
    </button>

    <!-- Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="flex justify-center gap-3">
                <form method="POST" action="{{ route('account.delete') }}" class="w-full max-w-sm text-center">
        @csrf
        @method('DELETE')

        <h2 class="text-lg font-semibold text-gray-800 mb-1">Are you sure you want to delete your account?</h2>
        <p class="text-sm text-gray-600 mb-6">This action cannot be undone.</p>

        <label for="password" class="block text-sm font-medium text-gray-700 mb-1 text-left">Enter your password</label>
        <input type="password" name="password" required
               class="w-full mb-6 border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">

        <div class="flex justify-center gap-4">
            <button type="button" @click="showModal = false"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm font-semibold">
                Cancel
            </button>

            <button type="submit"
                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-semibold">
                Yes, Delete
            </button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="//unpkg.com/alpinejs" defer></script>




@endsection
