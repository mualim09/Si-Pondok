<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        if (App::environment('production')) {
            URL::forceScheme('https');
        }

        \view()->composer('layouts.app', function ($view) {
            if (auth()->check()) {
                $preferensi = auth()->user()->preferensi()->first();
                if ($preferensi) {
                    return $view->with('preferensi', $preferensi);
                }
            } else {
                return redirect('/login');
            }
        });

    }
}
