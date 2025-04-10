<!-- resources/views/auth/register.blade.php -->
<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Left Side with Background Image and Overlay -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-green-600">
                <img src="{{ asset('images/campus.png') }}" alt="Campus View"
                    class="w-full h-full object-cover opacity-50">
            </div>

            <div class="relative z-10 p-12 flex flex-col justify-center h-full">
                <div class="flex items-center">
                    <div class="bg-white p-3 rounded-lg shadow-md">
                        <img src="{{ asset('images/school_logo.png') }}" alt="Logo" class="h-28">
                    </div>
                    <div class="ml-4">
                        <h2 class="text-white font-bold text-6xl">Baliwag Institute</h2>
                        <p class="text-white text-2xl">of Technology</p>
                    </div>
                </div>

                <div class="mt-12">
                    <h1 class="text-5xl font-bold text-white leading-tight mb-6">Begin Your Journey With Us Today</h1>
                    <p class="text-white text-lg max-w-md mb-8">Create your account and take the first step towards a
                        brighter future in education.</p>
                </div>
            </div>
        </div>

        <!-- Right Side with Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <!-- Logo for mobile -->
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/school_logo.png') }}" alt="Baliwag Institute of Technology"
                        class="h-32">
                </div>

                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Create an account</h1>
                    <p class="text-gray-600 mt-2">Please fill in your information to register</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Personal Information</h3>

                        <!-- Full Name Section -->
                        <div class="space-y-4">
                            <!-- First and Last Name - Side by Side -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="first_name" :value="__('First Name')"
                                        class="text-gray-700 font-medium" />
                                    <div class="relative mt-1">
                                        <x-text-input id="first_name"
                                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-green-600 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                            type="text" name="first_name" placeholder="Enter first name"
                                            :value="old('first_name')" required autofocus />
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="last_name" :value="__('Last Name')"
                                        class="text-gray-700 font-medium" />
                                    <div class="relative mt-1">
                                        <x-text-input id="last_name"
                                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                            type="text" name="last_name" placeholder="Enter last name"
                                            :value="old('last_name')" required />
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Middle Name and Extension - Side by Side -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="middle_name" :value="__('Middle Name')"
                                        class="text-gray-700 font-medium" />
                                    <div class="relative mt-1">
                                        <x-text-input id="middle_name"
                                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                            type="text" name="middle_name" placeholder="Enter middle name"
                                            :value="old('middle_name')" />
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <x-input-label for="extension_name" :value="__('Extension Name')"
                                        class="text-gray-700 font-medium" />
                                    <div class="relative mt-1">
                                        <select id="extension_name" name="extension_name"
                                            class="pl-10 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                            <option value="">Select Extension</option>
                                            @foreach (App\Enums\ExtensionName::cases() as $extension)
                                                <option value="{{ $extension->value }}"
                                                    {{ old('extension_name') == $extension->value ? 'selected' : '' }}>
                                                    {{ $extension->value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Information Section -->
                    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Account Information</h3>

                        <div class="space-y-4">
                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
                                <div class="relative mt-1">
                                    <x-text-input id="email"
                                        class="pl-10 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                        type="email" name="email" placeholder="your.email@example.com"
                                        :value="old('email')" required />
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <p class="text-xs text-gray-500 mt-1">We'll never share your email with anyone else.
                                </p>
                            </div>

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                                <div class="relative mt-1">
                                    <x-text-input id="password"
                                        class="pl-10 pr-10 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                        type="password" name="password" placeholder="••••••••" required />
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="absolute right-3 top-3 text-gray-600 hover:text-gray-800"
                                        onclick="togglePassword('password')">
                                        <svg class="h-5 w-5" id="showIcon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <p class="text-xs text-gray-500 mt-1">Use at least 8 characters with letters, numbers,
                                    and symbols.</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                                    class="text-gray-700 font-medium" />
                                <div class="relative mt-1">
                                    <x-text-input id="password_confirmation"
                                        class="pl-10 pr-10 w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                        type="password" name="password_confirmation" placeholder="••••••••"
                                        required />
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <button type="button"
                                        class="absolute right-3 top-3 text-gray-600 hover:text-gray-800"
                                        onclick="togglePassword('password_confirmation')">
                                        <svg class="h-5 w-5" id="showConfirmIcon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions Checkbox -->
                    {{-- <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox"
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-600">
                            I agree to the <a href="#" class="text-green-600 hover:underline">Terms of
                                Service</a> and <a href="#" class="text-green-600 hover:underline">Privacy
                                Policy</a>
                        </label>
                    </div> --}}

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-medium transition-colors flex items-center justify-center">
                        <span>Create Account</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-green-600 hover:text-green-500 font-medium">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            if (field) {
                field.type = field.type === 'password' ? 'text' : 'password';
            }
        }
    </script>
</x-guest-layout>
