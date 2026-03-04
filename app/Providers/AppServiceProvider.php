<?php

namespace App\Providers;

use App\Models\Livro;
use App\Observer\LivroObserver;
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
    }
}
