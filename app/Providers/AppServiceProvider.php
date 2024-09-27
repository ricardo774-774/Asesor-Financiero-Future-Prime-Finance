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
            // Excluir rutas de API del forzado de HTTPS
            if (!$this->app->request->is('suggest_savings')) {
                URL::forceScheme('https');
            }
        }
    }
}
