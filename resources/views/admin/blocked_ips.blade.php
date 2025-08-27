@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-center mb-6">Blocked IPs</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($blockedIps->isEmpty())
        <div class="text-center text-gray-500 text-lg">
            No IPs are currently blocked.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left border-b">ID</th>
                        <th class="py-3 px-6 text-left border-b">IP Address</th>
                        <th class="py-3 px-6 text-left border-b">Blocked At</th>
                        <th class="py-3 px-6 text-center border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blockedIps as $ip)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6 border-b">{{ $ip->id }}</td>
                        <td class="py-3 px-6 border-b">{{ $ip->ip_address }}</td>
                        <td class="py-3 px-6 border-b">{{ $ip->created_at->format('Y-m-d H:i:s') }}</td>
                        <td class="py-3 px-6 border-b text-center">
                            <form action="{{ route('admin.blocked-ips.unblock', $ip->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">
                                    Unblock
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
