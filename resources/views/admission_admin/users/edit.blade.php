@extends('layouts.dashboard')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

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
                            class="w-28 h-28 md:w-36 md:h-36 rounded-full overflow-hidden border-4 border-green-400 shadow-md mx-auto md:mx-0">
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
                </div>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form action="{{ route('users.update', $user->user_id) }}" method="POST">
                    @csrf
                    @method('PUT')

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

                    <!-- Tab Content Sections -->
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
                                            <label for="first_name"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">First Name
                                            </label>
                                            <input type="text" name="first_name" id="first_name"
                                                value="{{ old('first_name', $user->first_name) }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                                required>
                                            @error('first_name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <label for="last_name"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">Last Name
                                            </label>
                                            <input type="text" name="last_name" id="last_name"
                                                value="{{ old('last_name', $user->last_name) }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                                required>
                                            @error('last_name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <label for="middle_name"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">Middle
                                                Name</label>
                                            <input type="text" name="middle_name" id="middle_name"
                                                value="{{ old('middle_name', $user->middle_name) }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                            @error('middle_name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <label for="extension_name"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">Extension
                                                Name</label>
                                            <input type="text" name="extension_name" id="extension_name"
                                                value="{{ old('extension_name', $user->extension_name) }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                            @error('extension_name')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-5 rounded-lg">
                                    <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                        <i class="fas fa-info-circle text-green-500 mr-2"></i> Additional Information
                                    </h3>
                                    <div class="space-y-4">
                                        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <label for="blood_type"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">Blood
                                                Type</label>
                                            <select name="blood_type" id="blood_type"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                                <option value="">Select...</option>
                                                <option value="A+"
                                                    {{ old('blood_type', $user->blood_type) == 'A+' ? 'selected' : '' }}>A+
                                                </option>
                                                <option value="A-"
                                                    {{ old('blood_type', $user->blood_type) == 'A-' ? 'selected' : '' }}>A-
                                                </option>
                                                <option value="B+"
                                                    {{ old('blood_type', $user->blood_type) == 'B+' ? 'selected' : '' }}>B+
                                                </option>
                                                <option value="B-"
                                                    {{ old('blood_type', $user->blood_type) == 'B-' ? 'selected' : '' }}>B-
                                                </option>
                                                <option value="AB+"
                                                    {{ old('blood_type', $user->blood_type) == 'AB+' ? 'selected' : '' }}>
                                                    AB+</option>
                                                <option value="AB-"
                                                    {{ old('blood_type', $user->blood_type) == 'AB-' ? 'selected' : '' }}>
                                                    AB-</option>
                                                <option value="O+"
                                                    {{ old('blood_type', $user->blood_type) == 'O+' ? 'selected' : '' }}>O+
                                                </option>
                                                <option value="O-"
                                                    {{ old('blood_type', $user->blood_type) == 'O-' ? 'selected' : '' }}>O-
                                                </option>
                                            </select>
                                            @error('blood_type')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <label for="religion"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">Religion</label>
                                            <input type="text" name="religion" id="religion"
                                                value="{{ old('religion', $user->religion) }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                            @error('religion')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-5 rounded-lg">
                                    <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                                        <i class="fas fa-users text-green-500 mr-2"></i> Family Information
                                    </h3>
                                    <div class="space-y-4">
                                        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <label for="birth_order"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">Birth
                                                Order</label>
                                            <input type="number" name="birth_order" id="birth_order"
                                                value="{{ old('birth_order', $user->birth_order) }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                            @error('birth_order')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                            <label for="no_of_siblings"
                                                class="text-xs font-medium text-green-600 uppercase mb-1 block">Number of
                                                Siblings</label>
                                            <input type="number" name="no_of_siblings" id="no_of_siblings"
                                                value="{{ old('no_of_siblings', $user->no_of_siblings) }}"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                            @error('no_of_siblings')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
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
                                        <label for="email"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Email Address
                                        </label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', $user->email) }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                            required>
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <label for="contact_number"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Contact
                                            Number</label>
                                        <input type="tel" name="contact_number" id="contact_number"
                                            value="{{ old('contact_number', $user->contact_number) }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                        @error('contact_number')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm md:col-span-2">
                                        <label for="address"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Complete
                                            Address</label>
                                        <textarea name="address" id="address" rows="3"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
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
                                        <label for="date_of_birth"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Date of
                                            Birth</label>
                                        <input id="date_of_birth" type="date" name="date_of_birth"
                                            value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                        @error('date_of_birth')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <label for="age"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Age</label>
                                        <input type="number" name="age" id="age"
                                            value="{{ old('age', $user->age ?? '') }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                            readonly>
                                        @error('age')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <label for="sex"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Sex</label>
                                        <select name="sex" id="sex"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                            <option value="" {{ old('sex', $user->sex) == '' ? 'selected' : '' }}>
                                                Select...</option>
                                            <option value="male"
                                                {{ old('sex', $user->sex) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female"
                                                {{ old('sex', $user->sex) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other"
                                                {{ old('sex', $user->sex) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('sex')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <label for="civil_status"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Civil
                                            Status</label>
                                        <select name="civil_status" id="civil_status"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                            <option value="">Select...</option>
                                            <option value="Single"
                                                {{ old('civil_status', $user->civil_status) == 'Single' ? 'selected' : '' }}>
                                                Single</option>
                                            <option value="Married"
                                                {{ old('civil_status', $user->civil_status) == 'Married' ? 'selected' : '' }}>
                                                Married</option>
                                            <option value="Divorced"
                                                {{ old('civil_status', $user->civil_status) == 'Divorced' ? 'selected' : '' }}>
                                                Divorced</option>
                                            <option value="Widowed"
                                                {{ old('civil_status', $user->civil_status) == 'Widowed' ? 'selected' : '' }}>
                                                Widowed</option>
                                        </select>
                                        @error('civil_status')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <label for="citizenship"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Citizenship</label>
                                        <input type="text" name="citizenship" id="citizenship"
                                            value="{{ old('citizenship', $user->citizenship) }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                        @error('citizenship')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <label for="place_of_birth"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Place of
                                            Birth</label>
                                        <input type="text" name="place_of_birth" id="place_of_birth"
                                            value="{{ old('place_of_birth', $user->place_of_birth) }}"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                                        @error('place_of_birth')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
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
                                        <label for="status"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">Account Status
                                        </label>
                                        <select name="status" id="status" class="...">
                                            @foreach ($statusOptions as $option)
                                                <option value="{{ strtolower($option) }}"
                                                    {{ old('status', $user->status) == strtolower($option) ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                        <label for="role_id"
                                            class="text-xs font-medium text-green-600 uppercase mb-1 block">User Role
                                        </label>
                                        <select name="role_id" id="role_id"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                            required>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->role_id }}"
                                                    {{ old('role_id', $user->role_id) == $role->role_id ? 'selected' : '' }}>
                                                    {{ $role->role_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button Section -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <i class="fas fa-save mr-2"></i> Update User
                        </button>
                    </div>
                </form>
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

        // Calculate age only when elements exist
        function calculateAge() {
            const dobInput = document.getElementById('date_of_birth');
            const ageInput = document.getElementById('age');

            // Add null checks
            if (!dobInput || !ageInput) return;

            if (dobInput.value) {
                const dob = new Date(dobInput.value);
                const today = new Date();
                let age = today.getFullYear() - dob.getFullYear();

                const monthDiff = today.getMonth() - dob.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }
                ageInput.value = age;
            } else {
                ageInput.value = '';
            }
        }

        // Initialize only when needed
        document.addEventListener('DOMContentLoaded', function() {
            // Only run if elements exist on this page
            if (document.getElementById('date_of_birth') && document.getElementById('age')) {
                calculateAge();

                // Re-calculate when date changes
                document.getElementById('date_of_birth').addEventListener('change', calculateAge);
            }
        });
    </script>
@endsection
