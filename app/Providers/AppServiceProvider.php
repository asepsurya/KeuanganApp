<?php

namespace App\Providers;

use App\Models\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // App Settings
        $this->app->singleton('settings',function(){
            return Cache::rememberForever('settings', function () {
                return App::all()->pluck('value','key');
            });
        });
    }
}
