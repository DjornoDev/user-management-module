@extends('layouts.dashboard')

@section('title', 'Audit Logs')
@section('page-title', 'Audit Logs')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-green-800">System Activity History</h1>
            <a href="{{ route('admin.dashboard') }}"
                class="bg-white hover:bg-gray-100 text-green-700 border border-green-300 font-semibold py-2 px-4 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-green-700 mb-4">Filter Logs</h2>
            <form action="{{ route('admin.audit-logs') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Action</label>
                    <select name="action"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <option value="">All Actions</option>
                        @foreach ($actions as $action)
                            <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                {{ $action }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">User</label>
                    <select name="user_id"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        <option value="">All Users</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->user_id }}"
                                {{ request('user_id') == $user->user_id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                </div>

                <div class="md:col-span-2 lg:col-span-4 flex justify-end">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Apply Filters
                    </button>
                    <a href="{{ route('admin.audit-logs') }}"
                        class="bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 font-bold py-2 px-4 rounded">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Audit Logs Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">
                            Timestamp
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">User
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Action
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-green-800 uppercase tracking-wider">Details
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($auditLogs as $log)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $log->timestamp->format('M d, Y H:i:s') }}
                                <div class="text-xs text-gray-400">{{ $log->timestamp->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <div class="font-medium text-green-800">{{ $log->user->full_name }}</div>
                                <div class="text-xs">{{ $log->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if ($log->action == 'User Created') bg-green-100 text-green-800
                                @elseif($log->action == 'User Activated') bg-teal-100 text-teal-800
                                @elseif($log->action == 'User Updated') bg-indigo-100 text-indigo-800
                                @elseif($log->action == 'Profile Updated') bg-purple-100 text-purple-800
                                @elseif($log->action == 'Role Changed') bg-yellow-100 text-yellow-800
                                @elseif($log->action == 'User Deleted') bg-red-100 text-red-800
                                @elseif($log->action == 'User Deactivated') bg-orange-100 text-orange-800
                                @elseif($log->action == 'Account Self-Deleted') bg-pink-100 text-pink-800
                                @else bg-gray-100 text-gray-800 @endif">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div class="max-w-md">
                                    @if ($log->action == 'User Created')
                                        <p><strong>Name:</strong> {{ $log->details['user_name'] ?? 'N/A' }}</p>
                                        <p><strong>Email:</strong> {{ $log->details['user_email'] ?? 'N/A' }}</p>
                                        <p><strong>Role:</strong> {{ $log->details['role'] ?? 'N/A' }}</p>
                                        <p><strong>Created by:</strong> {{ $log->details['created_by'] ?? 'N/A' }}</p>
                                    @elseif($log->action == 'User Updated')
                                        <p><strong>Name:</strong> {{ $log->details['user_name'] ?? 'N/A' }}</p>
                                        <p><strong>Updated by:</strong> {{ $log->details['updated_by'] ?? 'N/A' }}</p>
                                        <button type="button"
                                            class="text-green-600 hover:text-green-800 text-xs toggle-details-btn"
                                            data-log-id="{{ $log->log_id }}">
                                            Show/Hide Changed Fields
                                        </button>
                                        <div id="details-{{ $log->log_id }}" class="hidden mt-2 bg-gray-50 rounded">
                                            <div class="p-3 border-b border-gray-200 bg-green-50">
                                                <div class="flex justify-between items-center">
                                                    <div class="font-medium">User Profile Changes</div>
                                                    <div class="text-xs text-gray-500">
                                                        Updated by: {{ $log->details['updated_by'] ?? 'Unknown' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-3">
                                                <table class="min-w-full text-xs">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left py-2 px-2 text-green-700 font-medium">Field
                                                            </th>
                                                            <th class="text-left py-2 px-2 text-green-700 font-medium">Old
                                                                Value</th>
                                                            <th class="text-left py-2 px-2 text-green-700 font-medium">New
                                                                Value</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (isset($log->details['old_values']) && isset($log->details['new_values']))
                                                            @foreach ($log->details['old_values'] as $field => $oldValue)
                                                                @if (isset($log->details['new_values'][$field]) && $log->details['new_values'][$field] != $oldValue)
                                                                    <tr class="border-t border-gray-100">
                                                                        <td class="py-2 px-2 align-top font-medium">
                                                                            {{ Str::title(str_replace('_', ' ', $field)) }}
                                                                        </td>
                                                                        <td
                                                                            class="py-2 px-2 align-top text-red-600 bg-red-50">
                                                                            {{ $oldValue }}
                                                                        </td>
                                                                        <td
                                                                            class="py-2 px-2 align-top text-green-600 bg-green-50">
                                                                            {{ $log->details['new_values'][$field] }}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3"
                                                                    class="py-2 px-2 text-center text-gray-500">
                                                                    No detailed change information available
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @elseif($log->action == 'Profile Updated')
                                        <p><strong>Changed Fields:</strong>
                                            {{ implode(', ', $log->details['changed_fields'] ?? ['Unknown']) }}
                                        </p>
                                    @elseif($log->action == 'Role Changed')
                                        <p><strong>User:</strong> {{ $log->details['user_name'] ?? 'N/A' }}</p>
                                        <p><strong>Old Role:</strong> {{ $log->details['old_role'] ?? 'N/A' }}</p>
                                        <p><strong>New Role:</strong> {{ $log->details['new_role'] ?? 'N/A' }}</p>
                                    @elseif($log->action == 'User Deleted' || $log->action == 'User Deactivated' || $log->action == 'User Activated')
                                        <p><strong>User:</strong> {{ $log->details['user_name'] ?? 'N/A' }}</p>
                                        <p><strong>Email:</strong> {{ $log->details['user_email'] ?? 'N/A' }}</p>
                                        @if (isset($log->details['deleted_by']) || isset($log->details['updated_by']))
                                            <p><strong>Action by:</strong>
                                                {{ $log->details['deleted_by'] ?? ($log->details['updated_by'] ?? 'N/A') }}
                                            </p>
                                        @endif
                                    @else
                                        <button type="button"
                                            class="text-green-600 hover:text-green-800 text-xs toggle-details-btn"
                                            data-log-id="{{ $log->log_id }}">
                                            Show Details
                                        </button>
                                        <div id="details-{{ $log->log_id }}"
                                            class="hidden mt-2 p-2 bg-gray-50 rounded text-xs">
                                            <pre>{{ json_encode($log->details, JSON_PRETTY_PRINT) }}</pre>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No audit logs found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $auditLogs->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.toggle-details-btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const logId = this.getAttribute('data-log-id');
                    const detailsElement = document.getElementById(`details-${logId}`);
                    if (detailsElement.classList.contains('hidden')) {
                        detailsElement.classList.remove('hidden');
                    } else {
                        detailsElement.classList.add('hidden');
                    }
                });
            });
        });
    </script>
@endsection
