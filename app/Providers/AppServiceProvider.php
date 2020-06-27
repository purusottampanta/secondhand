<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Composers\NavbarComposer;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

         // observers
        User::observe(UserObserver::class);
        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);

        $this->app['view']->composer(['layouts.app'], NavbarComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
