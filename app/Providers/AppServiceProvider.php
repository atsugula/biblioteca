<?php

namespace App\Providers;

use App\Servicios\Arboles\ArbolLibros;
use Illuminate\Support\ServiceProvider;
use App\Servicios\Arboles\ArbolCategorias;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Árbol de Libros
        $this->app->singleton(ArbolLibros::class, fn() => new ArbolLibros());

        // Árbol de Categorías
        $this->app->singleton(ArbolCategorias::class, fn() => new ArbolCategorias());
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
