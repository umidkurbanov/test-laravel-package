<?php

namespace UmidPackage;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class UmidPackageServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../configs/resova-api.php' => config_path('resova-api.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../configs/resova-api.php', 'resova-api'
        );

        $this->app->bind(ResovaApiClient::class);
    }
}