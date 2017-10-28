<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Auth\UserRegistered' => [
            'App\Listeners\Auth\UserRegisteredListener',
        ],
        'App\Events\Auth\EmailConfirmed' => [
            'App\Listeners\Auth\EmailConfirmedListener',
        ],
        'App\Events\Product\ProductViewCounter' => [
            'App\Listeners\Product\ProductViewCounterListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
