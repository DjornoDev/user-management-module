<!-- resources/views/profile/partials/update-profile-information-form.blade.php -->
<section>
    <header class="border-b border-green-200 pb-4">
        <h2 class="text-lg font-medium text-green-600">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-green-900">
            {{ __("Update your account's profile information and details.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Picture Section -->
        <div class="flex flex-col items-center mb-6">
            <div class="w-32 h-32 relative mb-4 group">
                <img id="profile-picture-preview"
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-profile.jpg') }}"
                    alt="Profile Picture"
                    class="w-32 h-32 rounded-full object-cover border-4 border-green-400 transition-all duration-200">
                <div
                    class="absolute bottom-0 right-0 bg-white p-1 rounded-full shadow transition-transform group-hover:scale-110">
                    <label for="profile_picture" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 transition-transform"
                            viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </label>
                    <input id="profile_picture" name="profile_picture" type="file" class="hidden" accept="image/*">
                </div>
            </div>
            <p class="text-sm text-green-600">Click the camera icon to update your profile picture</p>
        </div>

        <!-- Main Form Grid - Using full width with 2 columns -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full">
            <!-- Personal Information -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-green-100">
                <h3 class="font-medium text-green-700 mb-4 border-b border-green-100 pb-2">Personal Information</h3>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="first_name" :value="__('First Name')" class="text-green-800" />
                        <x-text-input id="first_name" name="first_name" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('first_name', $user->first_name)"
                            required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                    </div>

                    <div>
                        <x-input-label for="middle_name" :value="__('Middle Name')" class="text-green-800" />
                        <x-text-input id="middle_name" name="middle_name" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('middle_name', $user->middle_name)" />
                        <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                    </div>

                    <div>
                        <x-input-label for="last_name" :value="__('Last Name')" class="text-green-800" />
                        <x-text-input id="last_name" name="last_name" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('last_name', $user->last_name)"
                            required />
                        <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                    </div>

                    <div>
                        <x-input-label for="extension_name" :value="__('Extension Name')" class="text-green-800" />
                        <x-text-input id="extension_name" name="extension_name" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('extension_name', $user->extension_name)"
                            placeholder="Jr., Sr., III, etc." />
                        <x-input-error class="mt-2" :messages="$errors->get('extension_name')" />
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-green-100">
                <h3 class="font-medium text-green-700 mb-4 border-b border-green-100 pb-2">Contact Information</h3>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-green-800" />
                        <x-text-input id="email" name="email" type="email"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('email', $user->email)"
                            required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-green-800">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification"
                                        class="underline text-sm text-green-600 hover:text-green-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div>
                        <x-input-label for="contact_number" :value="__('Contact Number')" class="text-green-800" />
                        <x-text-input id="contact_number" name="contact_number" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('contact_number', $user->contact_number)" />
                        <x-input-error class="mt-2" :messages="$errors->get('contact_number')" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Complete Address')" class="text-green-800" />
                        <x-text-input id="address" name="address" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('address', $user->address)" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>
            </div>

            <!-- Personal Details -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-green-100">
                <h3 class="font-medium text-green-700 mb-4 border-b border-green-100 pb-2">Personal Details</h3>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="date_of_birth" :value="__('Date of Birth')" class="text-green-800" />
                        <x-text-input id="date_of_birth" name="date_of_birth" type="date"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old(
                                'date_of_birth',
                                $user->date_of_birth
                                    ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d')
                                    : null,
                            )" />
                        <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
                    </div>

                    <div>
                        <x-input-label for="age" :value="__('Age')" class="text-green-800" />
                        <x-text-input id="age" name="age" type="number"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('age', $user->age)"
                            readonly />
                        <x-input-error class="mt-2" :messages="$errors->get('age')" />
                    </div>

                    <div>
                        <x-input-label for="sex" :value="__('Sex')" class="text-green-800" />
                        <select id="sex" name="sex"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="" {{ old('sex', $user->sex) == '' ? 'selected' : '' }}>
                                Select...</option>
                            <option value="male" {{ old('sex', $user->sex) == 'male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="female" {{ old('sex', $user->sex) == 'female' ? 'selected' : '' }}>Female
                            </option>
                            <option value="other" {{ old('sex', $user->sex) == 'other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('sex')" />
                    </div>

                    <div>
                        <x-input-label for="civil_status" :value="__('Civil Status')" class="text-green-800" />
                        <select id="civil_status" name="civil_status"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">Select Civil Status</option>
                            <option value="Single"
                                {{ old('civil_status', $user->civil_status) == 'Single' ? 'selected' : '' }}>Single
                            </option>
                            <option value="Married"
                                {{ old('civil_status', $user->civil_status) == 'Married' ? 'selected' : '' }}>Married
                            </option>
                            <option value="Divorced"
                                {{ old('civil_status', $user->civil_status) == 'Divorced' ? 'selected' : '' }}>Divorced
                            </option>
                            <option value="Widowed"
                                {{ old('civil_status', $user->civil_status) == 'Widowed' ? 'selected' : '' }}>Widowed
                            </option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('civil_status')" />
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-green-100">
                <h3 class="font-medium text-green-700 mb-4 border-b border-green-100 pb-2">Additional Information</h3>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="citizenship" :value="__('Citizenship')" class="text-green-800" />
                        <x-text-input id="citizenship" name="citizenship" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('citizenship', $user->citizenship)" />
                        <x-input-error class="mt-2" :messages="$errors->get('citizenship')" />
                    </div>

                    <div>
                        <x-input-label for="place_of_birth" :value="__('Place of Birth')" class="text-green-800" />
                        <x-text-input id="place_of_birth" name="place_of_birth" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('place_of_birth', $user->place_of_birth)" />
                        <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
                    </div>

                    <div>
                        <x-input-label for="blood_type" :value="__('Blood Type')" class="text-green-800" />
                        <select id="blood_type" name="blood_type"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">Select Blood Type</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bloodType)
                                <option value="{{ $bloodType }}"
                                    {{ old('blood_type', $user->blood_type) == $bloodType ? 'selected' : '' }}>
                                    {{ $bloodType }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('blood_type')" />
                    </div>

                    <div>
                        <x-input-label for="religion" :value="__('Religion')" class="text-green-800" />
                        <x-text-input id="religion" name="religion" type="text"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('religion', $user->religion)" />
                        <x-input-error class="mt-2" :messages="$errors->get('religion')" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row Spanning Full Width -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full">
            <!-- Family Information -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-green-100">
                <h3 class="font-medium text-green-700 mb-4 border-b border-green-100 pb-2">Family Information</h3>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="birth_order" :value="__('Birth Order')" class="text-green-800" />
                        <x-text-input id="birth_order" name="birth_order" type="number" min="0"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('birth_order', $user->birth_order)" />
                        <x-input-error class="mt-2" :messages="$errors->get('birth_order')" />
                    </div>

                    <div>
                        <x-input-label for="no_of_siblings" :value="__('Number of Siblings')" class="text-green-800" />
                        <x-text-input id="no_of_siblings" name="no_of_siblings" type="number" min="0"
                            class="mt-1 block w-full focus:border-green-500 focus:ring-green-500" :value="old('no_of_siblings', $user->no_of_siblings)" />
                        <x-input-error class="mt-2" :messages="$errors->get('no_of_siblings')" />
                    </div>
                </div>
            </div>

            <!-- Account Information (Read-only) -->
            <div class="bg-white p-4 rounded-lg shadow-sm border border-green-100">
                <h3 class="font-medium text-green-700 mb-4 border-b border-green-100 pb-2">Account Information</h3>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="status" :value="__('Account Status')" class="text-green-800" />
                        <div class="mt-1 p-2 bg-gray-50 rounded border border-gray-200">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->status ?? 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="role" :value="__('User Role')" class="text-green-800" />
                        <div class="mt-1 p-2 bg-gray-50 rounded border border-gray-200">
                            {{ $user->role->role_name ?? 'N/A' }}
                        </div>
                    </div>

                    <div>
                        <x-input-label for="created_at" :value="__('Created On')" class="text-green-800" />
                        <div class="mt-1 p-2 bg-gray-50 rounded border border-gray-200">
                            {{ $user->created_at ? $user->created_at->format('F d, Y h:i A') : 'N/A' }}
                        </div>
                    </div>

                    <div>
                        <x-input-label for="last_login" :value="__('Last Login')" class="text-green-800" />
                        <div class="mt-1 p-2 bg-gray-50 rounded border border-gray-200">
                            {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('F d, Y h:i A') : 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-green-100">
            <x-primary-button class="bg-green-600 hover:bg-green-700">{{ __('Save Changes') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <script>
        // Auto-calculate age based on date of birth
        document.addEventListener('DOMContentLoaded', function() {
            const dobInput = document.getElementById('date_of_birth');
            const ageInput = document.getElementById('age');

            function calculateAge() {
                if (dobInput.value) {
                    const dob = new Date(dobInput.value);
                    const today = new Date();
                    let age = today.getFullYear() - dob.getFullYear();
                    const monthDiff = today.getMonth() - dob.getMonth();

                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                        age--;
                    }

                    ageInput.value = age;
                }
            }

            // Calculate on page load
            calculateAge();

            // Calculate when date of birth changes
            dobInput.addEventListener('change', calculateAge);
        });
    </script>
    <script>
        // Profile picture preview
        document.addEventListener('DOMContentLoaded', function() {
            const profilePicInput = document.getElementById('profile_picture');
            const profilePreview = document.querySelector('img[alt="Profile Picture"]');

            profilePicInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                        profilePreview.classList.add('ring-2', 'ring-green-400'); // Add visual feedback
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Optional: Add hover effect
            profilePreview.parentElement.addEventListener('mouseenter', function() {
                this.querySelector('svg').classList.add('scale-110');
            });

            profilePreview.parentElement.addEventListener('mouseleave', function() {
                this.querySelector('svg').classList.remove('scale-110');
            });
        });
    </script>
</section>
