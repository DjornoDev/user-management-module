<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admission Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-expanded {
            width: 16rem;
        }

        .sidebar-collapsed {
            width: 5rem;
        }

        .sidebar-transition {
            transition: width 0.3s ease-in-out;
        }

        .nav-icon {
            min-width: 1.25rem;
            width: 1.25rem;
            height: 1.25rem;
        }

        .tooltip {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .sidebar-collapsed .nav-item:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        .sort-icon {
            transition: transform 0.3s ease;
        }

        /* Profile Dropdown Styles */
        .profile-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            z-index: 50;
        }

        .profile-dropdown.show {
            display: block;
        }
    </style>
</head>

<body class="bg-content">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar"
            class="sidebar-expanded sidebar-transition bg-sidebar shadow-lg flex flex-col border-r border-gray-200">
            <!-- Logo -->
            <div class="flex items-center justify-center p-4 border-b border-gray-200">
                <div id="logo-full" class="w-full max-w-[150px]">
                    <img src="{{ asset('images/school_logo.png') }}" alt="Logo" class="w-full h-auto">
                </div>
                <div id="logo-icon" class="hidden w-10 h-10">
                    <img src="{{ asset('images/school_logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
                </div>
            </div>

            <!-- Sidebar Navigation Links -->
            <div class="flex-grow py-4">
                <nav>
                    <a href="{{ route('dashboard') }}"
                        class="nav-item flex items-center px-6 py-3 
                        @dashboardActive
text-gray-700 bg-green-100 border-r-4 border-green-400 border-primary
@else
text-gray-600 hover:bg-gray-100
@enddashboardActive 
                        relative">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="nav-icon h-6 w-6 mr-3 @dashboardActive
text-primary
@enddashboardActive"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="nav-text">Dashboard</span>
                        <span
                            class="tooltip bg-gray-800 text-white text-xs px-2 py-1 rounded absolute left-16 ml-2">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item flex items-center px-6 py-3 
        @userManagementActive
text-gray-700 bg-green-100 border-r-4 border-green-400 border-primary
@else
text-gray-600 hover:bg-gray-100
@enduserManagementActive 
        relative">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="nav-icon h-6 w-6 mr-3 @userManagementActive
text-primary
@enduserManagementActive"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="nav-text">User Management</span>
                        <span class="tooltip bg-gray-800 text-white text-xs px-2 py-1 rounded absolute left-16 ml-2">
                            User Management
                        </span>
                    </a>

                    <a href="#"
                        class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon h-6 w-6 mr-3" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="nav-text">Documents</span>
                        <span
                            class="tooltip bg-gray-800 text-white text-xs px-2 py-1 rounded absolute left-16 ml-2">Documents</span>
                    </a>
                    <a href="#"
                        class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon h-6 w-6 mr-3" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="nav-text">Settings</span>
                        <span
                            class="tooltip bg-gray-800 text-white text-xs px-2 py-1 rounded absolute left-16 ml-2">Settings</span>
                    </a>
                    <a href="#"
                        class="nav-item flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon h-6 w-6 mr-3" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="nav-text">Help</span>
                        <span
                            class="tooltip bg-gray-800 text-white text-xs px-2 py-1 rounded absolute left-16 ml-2">Help</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-4 py-3">
                    <!-- Toggle Button -->
                    <button id="toggle-sidebar" class="p-1 rounded-md hover:bg-gray-100 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- User Profile with Dropdown -->
                    <div class="relative">
                        <div class="flex items-center space-x-4 cursor-pointer" id="profile-trigger">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-700">{{ auth()->user()->full_name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->role->role_name }}</p>
                            </div>
                            <div class="h-10 w-10 rounded-full overflow-hidden border-2 border-primary">
                                <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/default-profile.jpg') }}"
                                    alt="User Profile" class="h-full w-full object-cover">
                            </div>
                            <!-- Dropdown Indicator -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        <!-- Profile Dropdown Menu -->
                        <div
                            class="profile-dropdown mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-200">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span>Profile</span>
                                </div>
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Logout</span>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-content p-4 scrollbar-custom">
                <!-- Dashboard Content Goes Here -->
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Sidebar Toggle Functionality with LocalStorage
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const logoFull = document.getElementById('logo-full');
            const logoIcon = document.getElementById('logo-icon');
            const navTexts = document.querySelectorAll('.nav-text');
            const toggleSidebarBtn = document.getElementById('toggle-sidebar');

            // Function to apply sidebar state
            function applySidebarState() {
                const isSidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

                if (isSidebarCollapsed) {
                    // Collapse sidebar
                    sidebar.classList.remove('sidebar-expanded');
                    sidebar.classList.add('sidebar-collapsed');

                    logoFull.classList.add('hidden');
                    logoIcon.classList.remove('hidden');

                    navTexts.forEach(text => {
                        text.classList.add('hidden');
                    });

                    const navItems = document.querySelectorAll('.nav-item');
                    navItems.forEach(item => {
                        item.classList.remove('px-6');
                        item.classList.add('px-4', 'justify-center');
                    });
                }
            }

            // Initial state application
            applySidebarState();

            // Toggle sidebar functionality
            toggleSidebarBtn.addEventListener('click', function() {
                // Toggle sidebar width
                sidebar.classList.toggle('sidebar-expanded');
                sidebar.classList.toggle('sidebar-collapsed');

                // Toggle logo
                logoFull.classList.toggle('hidden');
                logoIcon.classList.toggle('hidden');

                // Toggle nav text visibility
                navTexts.forEach(text => {
                    text.classList.toggle('hidden');
                });

                // Center icons when collapsed
                const navItems = document.querySelectorAll('.nav-item');
                if (sidebar.classList.contains('sidebar-collapsed')) {
                    // Save collapsed state to localStorage
                    localStorage.setItem('sidebarCollapsed', 'true');

                    navItems.forEach(item => {
                        item.classList.remove('px-6');
                        item.classList.add('px-4', 'justify-center');
                    });
                } else {
                    // Remove collapsed state from localStorage
                    localStorage.removeItem('sidebarCollapsed');

                    navItems.forEach(item => {
                        item.classList.remove('px-4', 'justify-center');
                        item.classList.add('px-6');
                    });
                }
            });

            // Profile Dropdown Toggle
            const profileTrigger = document.getElementById('profile-trigger');
            const profileDropdown = document.querySelector('.profile-dropdown');

            profileTrigger.addEventListener('click', function() {
                profileDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!profileTrigger.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.remove('show');
                }
            });
        });
    </script>
    <script src="{{ asset('js/modal-handler.js') }}"></script>
    <script src="{{ asset('js/users-management.js') }}"></script>
</body>

</html>
