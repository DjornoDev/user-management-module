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
        // Create a custom Blade directive for checking if dashboard route is active
        Blade::directive('dashboardActive', function () {
            return "<?php if(request()->routeIs('dashboard') || 
                           request()->routeIs('student.dashboard') || 
                           request()->routeIs('admin.dashboard') || 
                           request()->routeIs('program_head.dashboard') || 
                           request()->routeIs('faculty.dashboard')): ?>";
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
