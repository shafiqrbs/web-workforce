<?php

namespace App\Providers;

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
        view()->composer('layouts.partial.language_switcher', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // $this->app->bind('path.public', function() {
        //      return base_path().'/public_http';
        // });
    }

}
