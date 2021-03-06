<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
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
           $channels = \Cache::rememberForever('channels', function() {
               return Channel::all();
           });
           $view->with('channels', $channels);
        });

        // https://josephsilber.com/posts/2018/07/02/eloquent-polymorphic-relations-morph-map
        // this is to ensure we can store "reply" instead of "App\Reply" in favorited_type column in favorites table
        Relation::morphMap([
            'reply' => 'App\Reply',
            'activity' => 'App\Activity',
            'thread' => 'App\Thread',
            'favorite' => 'App\Favorite'
        ]);
    }
}
