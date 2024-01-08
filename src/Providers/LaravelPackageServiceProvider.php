<?php

namespace AreaWeb\LaravelPackage\Providers;

use AreaWeb\LaravelPackage\Currency;
use Illuminate\Support\ServiceProvider;

class LaravelPackageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Currency::class, Currency::class);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/laravel-package.php', 'laravel-package'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}