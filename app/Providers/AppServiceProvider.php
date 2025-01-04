<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator; // Import the correct Validator class
use Illuminate\Support\ServiceProvider;

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
        Validator::extend('filter', function($attribute, $value,$params) {
            return !in_array(strtolower($value),$params);
        }, 'The value is prohibited!');

        Paginator::useBootstrap();
    }  
}

