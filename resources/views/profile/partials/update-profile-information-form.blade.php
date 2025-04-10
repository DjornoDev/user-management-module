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
                        <select id="extension_name" name="extension_name"
                            class="mt-1 block w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">Select Extension</option>
                            @foreach (App\Enums\ExtensionName::cases() as $extension)
                                <option value="{{ $extension->value }}"
                                    {{ old('extension_name', $user->extension_name?->value) == $extension->value ? 'selected' : '' }}>
                                    {{ $extension->value }}
                                </option>
                            @endforeach
                        </select>
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
                        profilePreview.classList.add('ring-2', 'ring-green-400');
                    }
                    reader.readAsDataURL(file);
                }
            });

            profilePreview.parentElement.addEventListener('mouseenter', function() {
                this.querySelector('svg').classList.add('scale-110');
            });

            profilePreview.parentElement.addEventListener('mouseleave', function() {
                this.querySelector('svg').classList.remove('scale-110');
            });
        });
    </script>
</section>
