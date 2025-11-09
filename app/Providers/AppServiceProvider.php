<?php

namespace App\Providers;

use App\Servicios\Arboles\ArbolLibros;
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
        // Registramos el árbol de libros en el contenedor de servicios
        $this->app->singleton(ArbolLibros::class, function ($app) {
            return new ArbolLibros();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
