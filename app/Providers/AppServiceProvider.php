<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ConfigModels as Config;

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
        view()->share('config', Config::find(1));
    }
}
