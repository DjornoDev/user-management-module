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
                    <h1 class="text-5xl font-bold text-white leading-tight mb-6">Empowering Students Through Excellence
                    </h1>
                    <p class="text-white text-lg max-w-md mb-8">Join our community of learners and innovators to build
                        the future together.</p>
                </div>
            </div>
        </div>

        <!-- Right Side with Password Reset Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12">
            <div class="w-full max-w-md">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Logo for mobile -->
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/school_logo.png') }}" alt="Baliwag Institute of Technology"
                        class="h-32">
                </div>

                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Reset Your Password</h1>
                    <p class="text-gray-600 mt-2">Enter your email to receive a password reset link</p>
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input type="email" name="email" id="email" required autofocus
                                class="form-input pl-10 pr-3 py-3 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500"
                                placeholder="Enter your email" value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all cursor-pointer">
                        Send Reset Link
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>

                <!-- Back to Login Link -->
                <div class="text-center mt-8">
                    <p class="text-sm text-gray-600">
                        Remembered your password?
                        <a href="{{ route('login') }}" class="text-green-600 hover:text-green-500 font-medium">Sign in
                            here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
