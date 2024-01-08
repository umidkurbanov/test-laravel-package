<?php

namespace laravel_package;

use Carbon\Carbon;

class LaravelPackageClient
{
    public function getTime()
    {
        return Carbon::now();
    }
}