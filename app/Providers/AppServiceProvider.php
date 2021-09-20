<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\web_setting;

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
        view()->composer(['web.support.master'], function ($view) {
            $web_setting = web_setting::first();
            $view->with('web_setting', $web_setting);
        });
        
    }
}
