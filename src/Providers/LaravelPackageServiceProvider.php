<?php

namespace AreaWeb\LaravelPackage\Providers;

use AreaWeb\LaravelPackage\Services\TestService;
use Illuminate\Support\ServiceProvider;
use src\PCD;

class LaravelPackageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PCD::class, PCD::class);

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