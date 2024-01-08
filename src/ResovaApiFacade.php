<?php

namespace UmidPackage;

use Illuminate\Support\Facades\Facade;

class UmidPackageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ResovaApiClient::class;
    }
}
