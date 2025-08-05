@extends('layouts.admin')

@section('content')
    <div class="flex flex-col items-center mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4"style="margin-top:25px;">Manage Orders</h2>
    </div>
    <div class="flex justify-center mb-4">

    <div class="flex items-center bg-white rounded-lg shadow-sm border border-gray-200 px-4 py-2 w-1/2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
        <input
            type="text"
            id="order-search"
            placeholder="Search by user name, phone, or location..."
            class="ml-3 w-full bg-transparent focus:outline-none text-sm text-gray-700 placeholder-gray-400"
        />
    </div>
</div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-left text-gray-700 uppercase text-sm">
                        <th class="px-6 py-4 font-medium">User</th>
                        <th class="px-6 py-4 font-medium">Phone</th>
                        <th class="px-6 py-4 font-medium">Location</th>
                        <th class="px-6 py-4 font-medium">Items</th>
                        <th class="px-6 py-4 font-medium">Total</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="order-list" class="divide-y divide-gray-100">
                    @include('admin.partials.order-table')
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('order-search');

        searchInput.addEventListener('input', function () {
            const query = this.value;

            fetch(`/admin/orders/search?q=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.text())
            .then(html => {
                document.getElementById('order-list').innerHTML = html;
            })
            .catch(err => {
                console.error('Order search failed', err);
            });
        });
    });
</script>

@endsection
