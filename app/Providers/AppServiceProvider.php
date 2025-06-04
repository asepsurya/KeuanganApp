<?php

namespace App\Providers;

use App\Models\App;
use App\Models\User;
use App\Policies\AdminPolicy;
use Illuminate\Support\Facades\Gate;
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

        Gate::policy(User::class, AdminPolicy::class);
         // App Settings
        $this->app->singleton('settings',function(){
            return Cache::rememberForever('settings', function () {
                return App::all()->pluck('value','key');
            });
        });
    }
}
