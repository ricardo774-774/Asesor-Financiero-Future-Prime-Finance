<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        if (env('APP_ENV') !== "local") {
            // Forzar HTTPS solo si no se está haciendo una solicitud a la ruta específica
            if ($this->app->request->fullUrl() !== 'http://127.0.0.1:5000/suggest_savings') {
                URL::forceScheme('https');
            }
        }
    }
}
