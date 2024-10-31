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
            // Verificar si la solicitud actual es para la ruta que necesita HTTP
            if (!$this->app->request->is('suggest_savings')) {
                URL::forceScheme('https'); // Forzar HTTPS en rutas no excluidas
            } else {
                URL::forceScheme('http'); // Mantener HTTP en la ruta específica
            }
        }
    }
}
