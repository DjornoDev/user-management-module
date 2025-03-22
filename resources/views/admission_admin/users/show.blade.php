@extends('layouts.dashboard')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Back Link with better positioning -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}"
                class="text-green-600 hover:text-green-800 font-medium transition-colors flex items-center w-fit">
                <- Back to Users List </a>
        </div>

        <!-- Main Content Container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section with User Identity - Improved layout -->
            <div class="bg-green-50 border-b border-green-100">
                <div class="flex flex-col md:flex-row p-6 items-center md:items-start">
                    <!-- Profile Image - Better sizing and responsiveness -->
                    <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-8">
                        <div
                            class="w-28 h-28 md:w-36 md:h-36 rounded-full overflow-hidden border-4 border-white shadow-md mx-auto md:mx-0">
                            <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.jpg') }}"
                                alt="{{ $user->full_name }}" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- User Identity - Better spacing and alignment -->
                    <div class="flex-grow text-center md:text-left">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ $user->full_name }}</h1>
                        <div class="flex flex-wrap justify-center md:justify-start gap-2 mb-3">
                            <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $user->role->role_name }}
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <span
                                    class="w-2 h-2 mr-1 rounded-full {{ $user->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $user->status }}
                            </span>
                        </div>
                        <p class="text-gray-600 flex items-center justify-center md:justify-start mb-2">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>{{ $user->email }}
                        </p>
                        @if ($user->contact_number)
                            <p class="text-gray-600 flex items-center justify-center md:justify-start mb-2">
                                <i class="fas fa-phone text-gray-400 mr-2"></i>{{ $user->contact_number }}
                            </p>
                        @endif
                    </div>

                    <!-- Action Buttons - Better positioning -->
                    <div class="flex justify-center md:justify-end space-x-3 mt-4 md:mt-0 md:ml-4">
                        <a href="{{ route('users.edit', $user->user_id) }}"
                            class="bg-green-50 text-green-600 border border-green-600 py-2 px-4 rounded-lg hover:bg-green-100 transition-colors flex items-center">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-50 text-red-600 border border-red-600 py-2 px-4 rounded-lg hover:bg-red-100 transition-colors flex items-center"
                                onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- User Details Content - Improved layout -->
            <div class="p-6">
                <!-- Tabbed Navigation for Better Organization -->
                <ul class="flex flex-wrap border-b border-gray-200 mb-6 overflow-x-auto">
                    <li class="mr-2">
                        <a href="#personal"
                            class="inline-block py-2 px-4 text-green-600 font-medium border-b-2 border-green-600 rounded-t-lg active"
                            onclick="showTab('personal'); return false;">
                            <i class="fas fa-user mr-1"></i> Personal
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#contact"
                            class="inline-block py-2 px-4 text-gray-500 hover:text-green-600 font-medium hover:border-b-2 hover:border-green-600 rounded-t-lg"
                            onclick="showTab('contact'); return false;">
                            <i class="fas fa-address-book mr-1"></i> Contact
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#demographic"
                            class="inline-block py-2 px-4 text-gray-500 hover:text-green-600 font-medium hover:border-b-2 hover:border-green-600 rounded-t-lg"
                            onclick="showTab('demographic'); return false;">
                            <i class="fas fa-id-card mr-1"></i> Demographic
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#account"
                            class="inline-block py-2 px-4 text-gray-500 hover:text-green-600 font-medium hover:border-b-2 hover:border-green-600 rounded-t-lg"
                            onclick="showTab('account'); return false;">
                            <i class="fas fa-cog mr-1"></i> Account
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Personal Information Tab -->
                    <div id="personal" class="tab-pane block">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-5 rounded-lg">
                                <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                    <i class="fas fa-user-circle text-green-500 mr-2"></i> Basic Information
                                </h3>
                                <div class="space-y-4">
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">First Name</p>
                                        <p class="text-gray-800 font-medium">{{ $user->first_name }}</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">Last Name</p>
                                        <p class="text-gray-800 font-medium">{{ $user->last_name }}</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">Middle Name</p>
                                        <p class="text-gray-800">{{ $user->middle_name ?: 'N/A' }}</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">Extension Name</p>
                                        <p class="text-gray-800">{{ $user->extension_name ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-5 rounded-lg">
                                <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                    <i class="fas fa-info-circle text-green-500 mr-2"></i> Additional Information
                                </h3>
                                <div class="space-y-4">
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">Blood Type</p>
                                        <p class="text-gray-800">{{ $user->blood_type ?: 'N/A' }}</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">Religion</p>
                                        <p class="text-gray-800">{{ $user->religion ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-5 rounded-lg">
                                <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                    <i class="fas fa-users text-green-500 mr-2"></i> Family Information
                                </h3>
                                <div class="space-y-4">
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">Birth Order</p>
                                        <p class="text-gray-800">{{ $user->birth_order ?: 'N/A' }}</p>
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <p class="text-xs font-medium text-green-600 uppercase mb-1">Number of Siblings</p>
                                        <p class="text-gray-800">{{ $user->no_of_siblings ?: 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Tab -->
                    <div id="contact" class="tab-pane hidden">
                        <div class="bg-gray-50 p-5 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                <i class="fas fa-address-book text-green-500 mr-2"></i> Contact Details
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Email Address</p>
                                    <p class="text-gray-800 flex items-center">
                                        <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Contact Number</p>
                                    <p class="text-gray-800 flex items-center">
                                        <i class="fas fa-phone text-gray-400 mr-2"></i>
                                        {{ $user->contact_number ?: 'N/A' }}
                                    </p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm md:col-span-2">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Complete Address</p>
                                    <p class="text-gray-800 flex items-start">
                                        <i class="fas fa-map-marker-alt text-gray-400 mr-2 mt-1"></i>
                                        <span>{{ $user->address ?: 'No address provided' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Demographic Information Tab -->
                    <div id="demographic" class="tab-pane hidden">
                        <div class="bg-gray-50 p-5 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                <i class="fas fa-id-card text-green-500 mr-2"></i> Demographic Details
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Date of Birth</p>
                                    <p class="text-gray-800">
                                        {{ $user->date_of_birth ? $user->date_of_birth->format('F d, Y') : 'N/A' }}
                                    </p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Age</p>
                                    <p class="text-gray-800">{{ $user->age ?: 'N/A' }}</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Sex</p>
                                    <p class="text-gray-800">{{ $user->sex ?: 'N/A' }}</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Civil Status</p>
                                    <p class="text-gray-800">{{ $user->civil_status ?: 'N/A' }}</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Citizenship</p>
                                    <p class="text-gray-800">{{ $user->citizenship ?: 'N/A' }}</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Place of Birth</p>
                                    <p class="text-gray-800">{{ $user->place_of_birth ?: 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div id="account" class="tab-pane hidden">
                        <div class="bg-gray-50 p-5 rounded-lg">
                            <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                <i class="fas fa-cog text-green-500 mr-2"></i> Account Settings
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Account Status</p>
                                    <p class="flex items-center">
                                        <span
                                            class="w-3 h-3 mr-2 rounded-full {{ $user->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        <span class="text-gray-800 font-medium">{{ $user->status }}</span>
                                    </p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">User Role</p>
                                    <p class="flex items-center">
                                        <i class="fas fa-user-tag text-gray-400 mr-2"></i>
                                        <span class="text-gray-800 font-medium">{{ $user->role->role_name }}</span>
                                    </p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Created On</p>
                                    <p class="flex items-center text-gray-800">
                                        <i class="fas fa-calendar-plus text-gray-400 mr-2"></i>
                                        {{ $user->created_at ? $user->created_at->format('F d, Y h:i A') : 'N/A' }}
                                    </p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-medium text-green-600 uppercase mb-1">Last Login</p>
                                    <p class="flex items-center text-gray-800">
                                        <i class="fas fa-sign-in-alt text-gray-400 mr-2"></i>
                                        {{ $user->last_login ? $user->last_login->format('F d, Y h:i A') : 'Never logged in' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Switching Script -->
    <script>
        function showTab(tabId) {
            // Hide all tabs
            document.querySelectorAll('.tab-pane').forEach(tab => {
                tab.classList.add('hidden');
                tab.classList.remove('block');
            });

            // Show the selected tab
            document.getElementById(tabId).classList.remove('hidden');
            document.getElementById(tabId).classList.add('block');

            // Update active tab styling
            document.querySelectorAll('ul li a').forEach(link => {
                link.classList.remove('text-green-600', 'border-b-2', 'border-green-600');
                link.classList.add('text-gray-500');
            });

            document.querySelector(`a[href="#${tabId}"]`).classList.remove('text-gray-500');
            document.querySelector(`a[href="#${tabId}"]`).classList.add('text-green-600', 'border-b-2', 'border-green-600');
        }
    </script>
@endsection
