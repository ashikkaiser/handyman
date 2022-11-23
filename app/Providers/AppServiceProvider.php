<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['STRIPE_KEY' => json_decode(site('stripe'))->stripe_api]);
        config(['STRIPE_SECRET' => json_decode(site('stripe'))->stripe_secret]);



        // 
        // Share data to all views

    }
}
