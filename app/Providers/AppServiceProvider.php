<?php

namespace App\Providers;

use App\Models\Livro;
use App\Models\Locacao;
use App\Models\Usuario;
use App\Observer\LivroObserver;
use App\Observer\LocacaoObserver;
use App\Observer\UsuarioObserver;
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
        Livro::observe(LivroObserver::class);
        Usuario::observe(UsuarioObserver::class);
        Locacao::observe(LocacaoObserver::class);
    }
}
