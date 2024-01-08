<?php

namespace laravel_package;

use Illuminate\Support\Facades\Facade;

class LaravelPackageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return LaravelPackageClient::class;
    }
}