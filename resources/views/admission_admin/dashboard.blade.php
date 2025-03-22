@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Users')

@section('content')

    <!-- Main Stats Overview -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Admission Head Card -->
        <div class="bg-white rounded-lg shadow-sm p-4 border border-blue-100">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full card-icon-green flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="text-sm text-gray-600">Admission Head</span>
                </div>
            </div>
            <div class="text-3xl font-bold text-green-600 mb-2">{{ $admissionHeadCount }}</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $admissionHeadPercentage }}%"></div>
            </div>
            <div class="text-sm text-gray-500">{{ number_format($admissionHeadPercentage, 1) }}% of total users</div>
        </div>

        <!-- Program Head Card -->
        <div class="bg-white rounded-lg shadow-sm p-4 border border-blue-100">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full card-icon-red flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span class="text-sm text-gray-600">Program Head</span>
                </div>
            </div>
            <div class="text-3xl font-bold text-red-600 mb-2">{{ $programHeadCount }}</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                <div class="bg-red-500 h-2.5 rounded-full" style="width: {{ $programHeadPercentage }}%"></div>
            </div>
            <div class="text-sm text-gray-500">{{ number_format($programHeadPercentage, 1) }}% of total users</div>
        </div>

        <!-- Faculty Facilitator Card -->
        <div class="bg-white rounded-lg shadow-sm p-4 border border-blue-100">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full card-icon-yellow flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-sm text-gray-600">Faculty Facilitator</span>
                </div>
            </div>
            <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $facultyFacilitatorCount }}</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                <div class="bg-yellow-500 h-2.5 rounded-full" style="width: {{ $facultyPercentage }}%"></div>
            </div>
            <div class="text-sm text-gray-500">{{ number_format($facultyPercentage, 1) }}% of total users</div>
        </div>

        <!-- Student Applicant Card -->
        <div class="bg-white rounded-lg shadow-sm p-4 border border-blue-100">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full card-icon-blue flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <span class="text-sm text-gray-600">Student Applicant</span>
                </div>
            </div>
            <div class="text-3xl font-bold text-blue-600 mb-2">{{ $studentApplicantCount }}</div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mb-1">
                <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $studentPercentage }}%"></div>
            </div>
            <div class="text-sm text-gray-500">{{ number_format($studentPercentage, 1) }}% of total users</div>
        </div>
    </div>

    {{-- Users Table --}}
    <div
        class="bg-white rounded-lg shadow-md p-6 mb-6 border border-blue-200 hover:shadow-lg transition-shadow duration-300">
        <!-- Header and Search -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Users Management
            </h2>
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add User
                </a>
                <div class="relative w-full md:w-64 group">
                    <input type="text" id="searchInput" placeholder="Search users..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400 group-hover:text-blue-500 transition-colors duration-300"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="w-full md:w-auto">
                    <select id="sortDropdown"
                        class="w-full md:w-48 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 cursor-pointer">
                        <option value="name_asc">Name (A-Z)</option>
                        <option value="name_desc">Name (Z-A)</option>
                        <option value="email_asc">Email (A-Z)</option>
                        <option value="email_desc">Email (Z-A)</option>
                        <option value="role_asc">Role (A-Z)</option>
                        <option value="role_desc">Role (Z-A)</option>
                        <option value="status_asc">Status (Active first)</option>
                        <option value="status_desc">Status (Inactive first)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Filter Chips -->
        <div class="flex flex-wrap gap-2 mb-4">
            <button id="filterAll"
                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors duration-300 flex items-center">
                All
            </button>
            <button id="filterActive" data-filter-type="status" data-filter-value="Active"
                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors duration-300 flex items-center">
                Active
                <span
                    class="ml-1 flex items-center justify-center bg-green-500 text-white rounded-full w-5 h-5 text-xs">{{ $activeCount }}</span>
            </button>
            <button id="filterInactive" data-filter-type="status" data-filter-value="Inactive"
                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors duration-300 flex items-center">
                Inactive
                <span
                    class="ml-1 flex items-center justify-center bg-red-500 text-white rounded-full w-5 h-5 text-xs">{{ $inactiveCount }}</span>
            </button>
            <button id="filterAdmin" data-filter-type="role" data-filter-value="AA"
                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors duration-300 flex items-center">
                Admin
                <span
                    class="ml-1 flex items-center justify-center bg-blue-500 text-white rounded-full w-5 h-5 text-xs">{{ $adminCount }}</span>
            </button>
            <button id="filterFaculty" data-filter-type="role" data-filter-value="FF"
                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors duration-300 flex items-center">
                Faculty
                <span
                    class="ml-1 flex items-center justify-center bg-blue-500 text-white rounded-full w-5 h-5 text-xs">{{ $facultyCount }}</span>
            </button>

            <button id="filterProgramHead" data-filter-type="role" data-filter-value="PH"
                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors duration-300 flex items-center">
                Program Head
                <span
                    class="ml-1 flex items-center justify-center bg-blue-500 text-white rounded-full w-5 h-5 text-xs">{{ $programHeadCount }}</span>
            </button>

            <button id="filterStudentApplicant" data-filter-type="role" data-filter-value="SA"
                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-300 transition-colors duration-300 flex items-center">
                Student Applicant
                <span
                    class="ml-1 flex items-center justify-center bg-blue-500 text-white rounded-full w-5 h-5 text-xs">{{ $studentApplicantCount }}</span>
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table id="usersTable" class="min-w-full bg-white">
                <thead class="bg-gradient-to-r from-blue-50 to-indigo-50">
                    <tr>
                        <th class="sortable py-4 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-blue-100 transition-colors duration-300"
                            data-column="name">
                            <div class="flex items-center">
                                Name
                                <svg xmlns="http://www.w3.org/2000/svg" class="sort-icon ml-1 h-4 w-4 text-blue-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                        <th class="sortable py-4 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-blue-100 transition-colors duration-300"
                            data-column="email">
                            <div class="flex items-center">
                                Email
                                <svg xmlns="http://www.w3.org/2000/svg" class="sort-icon ml-1 h-4 w-4 text-blue-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                        <th class="sortable py-4 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-blue-100 transition-colors duration-300"
                            data-column="role">
                            <div class="flex items-center">
                                Role
                                <svg xmlns="http://www.w3.org/2000/svg" class="sort-icon ml-1 h-4 w-4 text-blue-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                        <th class="py-4 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            Phone
                        </th>
                        <th class="sortable py-4 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider cursor-pointer hover:bg-blue-100 transition-colors duration-300"
                            data-column="status">
                            <div class="flex items-center">
                                Status
                                <svg xmlns="http://www.w3.org/2000/svg" class="sort-icon ml-1 h-4 w-4 text-blue-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                        <th class="py-4 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody id="userTableBody" class="divide-y divide-gray-200">
                    <!-- Table rows will be generated by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Replace your current pagination buttons with this -->
        <div class="flex flex-col sm:flex-row justify-between items-center mt-6">
            <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                Showing <span id="shownCount" class="font-medium text-blue-700">5</span> of
                <span id="totalCount" class="font-medium text-blue-700">10</span> users
            </div>
            <div class="flex space-x-2">
                <button id="prevButton"
                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-blue-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-300 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </button>
                <div class="pagination-buttons-container flex border border-gray-300 rounded-lg overflow-hidden">
                    <!-- Pagination buttons will be generated here -->
                </div>
                <button id="nextButton"
                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-blue-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-300 flex items-center">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Activity Overview/Audit Log -->
    <div class="grid grid-cols-1 gap-6 mb-6 shadow-lg">
        <!-- Recent Activity -->
        <div class="md:col-span-2 bg-white rounded-lg shadow-sm p-6 border border-blue-100">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Recent Activity</h2>
                <a href="{{ route('admin.audit-logs') }}"
                    class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All Activity</a>
            </div>
            <div class="space-y-4">
                @forelse($recentAuditLogs as $log)
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-10">
                            <div
                                class="h-8 w-8 rounded-full 
                            @if ($log->action == 'User Created' || $log->action == 'User Activated') bg-green-100 
                            @elseif($log->action == 'User Updated' || $log->action == 'Profile Updated') 
                                bg-blue-100 
                            @elseif($log->action == 'Role Changed') 
                                bg-yellow-100 
                            @elseif($log->action == 'User Deleted' || $log->action == 'User Deactivated' || $log->action == 'Account Self-Deleted') 
                                bg-red-100 
                            @else 
                                bg-gray-100 @endif
                            flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 
                                @if ($log->action == 'User Created' || $log->action == 'User Activated') text-green-600 
                                @elseif($log->action == 'User Updated' || $log->action == 'Profile Updated') 
                                    text-blue-600 
                                @elseif($log->action == 'Role Changed') 
                                    text-yellow-600 
                                @elseif($log->action == 'User Deleted' || $log->action == 'User Deactivated' || $log->action == 'Account Self-Deleted') 
                                    text-red-600 
                                @else 
                                    text-gray-600 @endif"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    @if ($log->action == 'User Created' || $log->action == 'User Activated')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    @elseif($log->action == 'User Updated' || $log->action == 'Profile Updated')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    @elseif($log->action == 'Role Changed')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    @elseif($log->action == 'User Deleted' || $log->action == 'User Deactivated' || $log->action == 'Account Self-Deleted')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    @endif
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">{{ $log->action }}</div>
                            <div class="text-sm text-gray-500">
                                @if ($log->action == 'User Created')
                                    {{ $log->details['user_name'] }} joined as {{ $log->details['role'] ?? 'New User' }}
                                @elseif($log->action == 'User Updated')
                                    {{ $log->details['user_name'] }}'s account details were updated
                                @elseif($log->action == 'Profile Updated')
                                    {{ $log->user->full_name }} updated their profile details
                                @elseif($log->action == 'Role Changed')
                                    {{ $log->details['user_name'] }} changed from {{ $log->details['old_role'] }} to
                                    {{ $log->details['new_role'] }}
                                @elseif($log->action == 'User Deleted')
                                    {{ $log->details['user_name'] }}'s account has been deleted
                                @elseif($log->action == 'User Deactivated')
                                    {{ $log->details['user_name'] }}'s account has been deactivated
                                @elseif($log->action == 'User Activated')
                                    {{ $log->details['user_name'] }}'s account has been activated
                                @elseif($log->action == 'Account Self-Deleted')
                                    {{ $log->details['user_name'] }} deleted their own account
                                @else
                                    Action performed by {{ $log->user->full_name }}
                                @endif
                            </div>
                            <div class="text-xs text-gray-400 mt-1">{{ $log->timestamp->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-4">
                        No recent activity to display
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Password Validation Modal - White and Green Theme -->
    <div id="passwordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="relative top-1/2 transform -translate-y-1/2 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Security Verification</h3>
                <div class="mt-2 px-7 py-3">
                    <form id="passwordForm" method="POST">
                        @csrf
                        <input type="password" name="password" id="passwordInput"
                            class="w-full px-3 py-2 border border-green-300 focus:ring-2 focus:ring-green-200 focus:border-green-500 rounded-md"
                            placeholder="Enter your password" required>
                        <div id="passwordError" class="text-red-500 text-sm mt-2 hidden"></div>
                        <div class="mt-4 flex justify-center space-x-3">
                            <button type="button" onclick="closePasswordModal()"
                                class="px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-200 transition duration-200">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-sm transition duration-200">
                                Verify
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <!-- Modal Container -->
        <div class="w-96 bg-white rounded shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-red-500 text-white px-4 py-3 flex justify-between items-center">
                <h3 class="font-medium text-lg">Delete User</h3>
                <button onclick="closeDeleteModal()" class="text-white hover:text-red-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Warning Icon -->
            <div class="flex justify-center mt-6">
                <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-red-500">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                        </path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
            </div>

            <!-- Confirmation Text -->
            <div class="text-center px-6 mt-4">
                <p class="text-gray-800 font-medium">Are you sure you want to delete this user?</p>
                <p class="text-gray-600 mt-1">You are about to delete <span class="font-medium"
                        data-field="name"></span>. This action cannot be undone.</p>
            </div>

            <!-- User Info -->
            <div class="px-6 mt-4">
                <div class="text-sm">
                    <p class="flex items-center mb-1">
                        <span class="text-gray-600 inline-block w-16">Email:</span>
                        <span class="text-gray-800" data-field="email"></span>
                    </p>
                    <p class="flex items-center mb-1">
                        <span class="text-gray-600 inline-block w-16">Role:</span>
                        <span class="text-gray-800" data-field="role"></span>
                    </p>
                    <p class="flex items-center mb-1">
                        <span class="text-gray-600 inline-block w-16">Status:</span>
                        <span class="text-gray-800" data-field="status"></span>
                    </p>
                </div>
            </div>

            <!-- Warning Section -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 mx-6 mt-4">
                <div class="flex">
                    <div class="ml-1">
                        <p class="text-sm font-medium text-gray-800">Warning: Deleting this user will:</p>
                        <ul class="list-disc text-sm text-gray-700 pl-5 mt-1">
                            <li>Remove all user access permissions</li>
                            <li>Delete all user account information</li>
                            <li>Remove user from all assigned projects</li>
                            <li>Archive their activity history</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-2 px-6 py-4 mt-2">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded transition-colors duration-200">
                    Cancel
                </button>
                <button id="confirmDeleteBtn"
                    class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded transition-colors duration-200">
                    Delete User
                </button>
            </div>
        </div>
    </div>
@endsection
