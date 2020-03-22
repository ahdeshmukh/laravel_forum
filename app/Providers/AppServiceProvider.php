<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Channel;

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
        // share the variable $channels with every view
        // Imp: cannot use database calls like Channel:all with View::share
        // this will cause errors in all the tests
        // reason being View::share is invoked before RefreshDatabase
        // which produces table not found error

        View::composer('*', function($view) {
           $view->with('channels', Channel::all());
        });
    }
}
