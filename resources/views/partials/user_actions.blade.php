<div class="flex space-x-2">
    <button onclick="showPasswordModal('view', {{ $user->user_id }})" class="text-blue-600 hover:text-blue-800">
        View
    </button>
    <span>|</span>
    <button onclick="showPasswordModal('edit', {{ $user->user_id }})" class="text-blue-600 hover:text-blue-800">
        Edit
    </button>
    <span>|</span>
    <button onclick="showDeleteModal(this)" data-user-id="{{ $user->user_id }}" data-name="{{ $user->full_name }}"
        data-email="{{ $user->email }}" data-role="{{ $user->role->role_name }}" data-status="{{ $user->status }}"
        class="text-red-600 hover:text-red-800">
        Delete
    </button>
    <form id="deleteForm-{{ $user->user_id }}" action="{{ route('users.destroy', $user->user_id) }}"
        method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
