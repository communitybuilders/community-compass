<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        // boot() is normally triggered before Auth.
        // Use a view composer to allow all views to access
        // var.

        View::composer('*', function($view) {
            $guestOrUser = Auth::guest() ? 'guest' : 'user';
            $view->with('guestOrUser', $guestOrUser);
        });
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
