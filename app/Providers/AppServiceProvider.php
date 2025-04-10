<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // For dashboard
        Blade::directive('dashboardActive', function () {
            return "<?php if(request()->routeIs('dashboard') ||
                   request()->routeIs('student.dashboard') ||
                   request()->routeIs('program_head.dashboard') ||
                   request()->routeIs('faculty.dashboard')): ?>";
            // Remove admin.dashboard from this list
        });

        // For user management
        Blade::directive('userManagementActive', function () {
            return "<?php if(request()->routeIs('admin.dashboard') ||
              request()->routeIs('users.*') ||
              request()->routeIs('admin.audit-logs')): ?>";
            // This can stay the same
        });

        // Add its ending directive
        Blade::directive('enduserManagementActive', function () {
            return "<?php endif; ?>";
        });

        // Create ending directive for dashboard active
        Blade::directive('enddashboardActive', function () {
            return "<?php endif; ?>";
        });

        // Create a custom Blade directive for checking if profile route is active
        Blade::directive('profileActive', function () {
            return "<?php if(request()->routeIs('profile.*')): ?>";
        });

        // Create ending directive for profile active
        Blade::directive('endprofileActive', function () {
            return "<?php endif; ?>";
        });
    }
}
