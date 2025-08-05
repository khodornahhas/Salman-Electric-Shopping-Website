@forelse ($users as $user)
<tr>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
        {{ $user->name }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ $user->email }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ $user->phone ?? '—' }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        {{ $user->orders_count ?? 0 }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this user?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900 focus:outline-none">
                Delete
            </button>
        </form>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="text-center py-8 text-gray-500">No users found.</td>
</tr>
@endforelse
