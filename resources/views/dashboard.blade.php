@extends('layouts.dashboard')

@section('title', 'BIT Dashboard')
@section('page-title', 'BIT Dashboard')

@section('content')
    <div class="min-h-[80vh] flex flex-col items-center justify-center p-6 animate-fade-in">
        <!-- Animated Empty State Container -->
        <div class="relative w-full max-w-2xl mx-auto text-center">
            <!-- Animated Dots Background -->
            <div class="absolute inset-0 -z-10 overflow-hidden">
                <div class="absolute w-2 h-2 bg-green-400 rounded-full top-12 left-1/4 animate-ping-slow"></div>
                <div class="absolute w-3 h-3 bg-blue-300 rounded-full top-24 right-1/3 animate-ping-slower"></div>
                <div class="absolute w-2 h-2 bg-amber-300 rounded-full bottom-12 left-1/3 animate-ping-slow"></div>
                <div class="absolute w-4 h-4 bg-purple-200 rounded-full bottom-24 right-1/4 animate-ping-slowest"></div>
            </div>

            <!-- Main Content -->
            <div class="p-8 bg-white/50 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-100">
                <!-- Animated Icon -->
                <div class="mx-auto w-24 h-24 mb-6 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-green-500 animate-pulse-subtle"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <!-- Animated Ring -->
                    <div class="absolute inset-0 border-4 border-green-200 rounded-full animate-spin-slow"></div>
                </div>

                <!-- Text Content -->
                <h2 class="text-2xl font-bold text-gray-800 mb-3 animate-slide-up">Welcome to Your BIT Dashboard</h2>
                <p class="text-gray-600 mb-8 max-w-md mx-auto animate-slide-up-delay">Your personalized dashboard is ready
                    to be filled with data. Add your first widget to get started.</p>

                <!-- Action Button with Hover Effect -->
                <button
                    class="inline-flex items-center px-5 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 active:scale-95 group animate-bounce-subtle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 group-hover:animate-spin-once"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Your First Widget
                </button>

                <!-- Quick Links -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-4 animate-fade-in-up">
                    <div
                        class="p-4 bg-white/80 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-blue-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="font-medium text-gray-700">View Reports</h3>
                    </div>
                    <div
                        class="p-4 bg-white/80 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-purple-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="font-medium text-gray-700">Manage Users</h3>
                    </div>
                    <div
                        class="p-4 bg-white/80 rounded-lg border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto mb-2 text-amber-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="font-medium text-gray-700">Configure Settings</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tailwind Custom Animation Classes -->
    <style>
        @keyframes ping-slow {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.5);
                opacity: 0.5;
            }
        }

        @keyframes ping-slower {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.8);
                opacity: 0.4;
            }
        }

        @keyframes ping-slowest {

            0%,
            100% {
                transform: scale(1);
                opacity: 0.7;
            }

            50% {
                transform: scale(2);
                opacity: 0.3;
            }
        }

        @keyframes spin-slow {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse-subtle {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        @keyframes slide-up {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slide-up-delay {
            0% {
                transform: translateY(20px);
                opacity: 0;
            }

            30% {
                transform: translateY(20px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce-subtle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        @keyframes spin-once {
            to {
                transform: rotate(180deg);
            }
        }

        .animate-ping-slow {
            animation: ping-slow 3s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .animate-ping-slower {
            animation: ping-slower 4s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .animate-ping-slowest {
            animation: ping-slowest 5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        .animate-spin-slow {
            animation: spin-slow 8s linear infinite;
        }

        .animate-pulse-subtle {
            animation: pulse-subtle 2s ease-in-out infinite;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out forwards;
        }

        .animate-slide-up-delay {
            animation: slide-up-delay 0.8s ease-out forwards;
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
            animation-delay: 0.3s;
            opacity: 0;
        }

        .animate-bounce-subtle {
            animation: bounce-subtle 2s ease-in-out infinite;
        }

        .group-hover\:animate-spin-once:hover {
            animation: spin-once 0.5s ease-out forwards;
        }
    </style>
@endsection
