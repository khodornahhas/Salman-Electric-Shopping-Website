@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Promo Codes</h1>
        <a href="{{ route('admin.promocodes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Create New Promo Code
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($promocodes->count())
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded shadow-sm">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="py-2 px-4 border-b">Code</th>
                        <th class="py-2 px-4 border-b">Discount %</th>
                        <th class="py-2 px-4 border-b">Expires At</th>
                        <th class="py-2 px-4 border-b">Products</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promocodes as $promo)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $promo->code }}</td>
                            <td class="py-2 px-4 border-b">{{ $promo->discount_percent }}%</td>
                            <td class="py-2 px-4 border-b">
                                {{ $promo->expires_at ? $promo->expires_at->format('Y-m-d') : 'No Expiry' }}
                            </td>
                            <td class="py-2 px-4 border-b">
                                @foreach($promo->products as $product)
                                    <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mr-1 mb-1 text-sm">
                                        {{ $product->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="py-2 px-4 border-b flex gap-2">
                                <form action="{{ route('admin.promocodes.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this promo code?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $promocodes->links() }}
        </div>
    @else
        <p class="text-gray-500">No promo codes found.</p>
    @endif
</div>
@endsection
