<?php

namespace laravel_package;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class LaravelPackageServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-package.php' => config_path('laravel-package.php'),
        ]);
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-package.php', 'laravel-package.php'
        );

        $this->app->bind(LaravelPackageClient::class);
    }
}
