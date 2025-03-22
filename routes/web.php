<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
require __DIR__ . '/auth.php';

// Authenticated + Verified Email Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Common Dashboard Redirect
    Route::get('/dashboard', function () {
        return redirect(auth()->user()->getRedirectPath());
    })->name('dashboard');

    // Profile Management
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Student Applicant Routes
    Route::middleware(['role:SA'])->group(function () {
        Route::get('/student-applicant-dashboard', function () {
            return view('student_applicant.dashboard');
        })->name('student.dashboard');
    });

    // Admission Admin Routes
    Route::middleware(['role:AA'])->prefix('admin')->group(function () {
        Route::get('/admin-dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users/data', [UserController::class, 'getUsersData'])->name('users.data');

        // Add the audit logs route
        Route::get('/audit-logs', [UserController::class, 'auditLogs'])->name('admin.audit-logs');

        Route::resource('users', UserController::class);
    });

    // Program Head Routes
    Route::middleware(['role:PH'])->group(function () {
        Route::get('/program-head-dashboard', function () {
            return view('program_head.dashboard');
        })->name('program_head.dashboard');
    });

    // Faculty Facilitator Routes
    Route::middleware(['role:FF'])->group(function () {
        Route::get('/faculty-facilitator-dashboard', function () {
            return view('faculty_facilitator.dashboard');
        })->name('faculty.dashboard');
    });
});

Route::post('/admin/verify-password', [UserController::class, 'verifyPassword'])
    ->middleware(['auth', 'verified', 'role:AA'])
    ->name('verify.password');
