<?php

namespace App\Providers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Illuminate\Auth\Events\PasswordReset::class => [
            \App\Listeners\SendEmailVerificationAfterPasswordReset::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
