@extends('layouts.dashboard')

@section('title', 'Create User')
@section('page-title', 'Create User')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Back Link with better positioning -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}"
                class="text-green-600 hover:text-green-800 font-medium transition-colors flex items-center w-fit">
                <- Back to Users List </a>
        </div>

        <!-- Main Content Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <!-- Header Section -->
            <div class="border-b border-gray-200 bg-green-100">
                <div class="px-6 py-5">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-user-plus text-green-600 mr-3"></i> Create New User
                    </h1>
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 mb-6 p-4 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm leading-5 font-medium text-red-800">There were {{ $errors->count() }}
                                    errors with your submission</h3>
                                <div class="mt-2 text-sm leading-5 text-red-700">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="mb-8 p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
                        <h3
                            class="text-lg font-semibold text-green-700 flex items-center mb-4 pb-2 border-b border-gray-100">
                            <i class="fas fa-user-circle text-green-500 mr-2"></i> Personal Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">First Name *</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Last Name *</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                    <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Extension Name</label>
                                    <select name="extension_name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                        <option value="">Select Extension</option>
                                        @foreach (App\Enums\ExtensionName::cases() as $extension)
                                            <option value="{{ $extension->value }}"
                                                {{ old('extension_name') == $extension->value ? 'selected' : '' }}>
                                                {{ $extension->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information Section -->
                    <div class="mb-8 p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
                        <h3
                            class="text-lg font-semibold text-green-700 flex items-center mb-4 pb-2 border-b border-gray-100">
                            <i class="fas fa-cog text-green-500 mr-2"></i> Account Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role *</label>
                                <select name="role_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}"
                                            {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status *</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                    @foreach ($statusOptions as $option)
                                        <option value="{{ strtolower($option) }}"
                                            {{ old('status') == strtolower($option) ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="mb-8 p-6 bg-white rounded-lg border border-gray-200 shadow-sm">
                        <h3
                            class="text-lg font-semibold text-green-700 flex items-center mb-4 pb-2 border-b border-gray-100">
                            <i class="fas fa-address-book text-green-500 mr-2"></i> Contact Information
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text" name="contact_number" value="{{ old('contact_number') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-3 mt-8">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <i class="fas fa-check mr-2"></i> Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
