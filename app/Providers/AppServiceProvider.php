<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        if (request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        
        // Load helper functions trực tiếp
        require_once app_path('Helpers/RouteHelper.php');
    }
}
