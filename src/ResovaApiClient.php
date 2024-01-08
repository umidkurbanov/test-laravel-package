<?php

namespace UmidPackage;

use Carbon\Carbon;

class UmidPackageClient
{
    public function getTime()
    {
        return Carbon::now();
    }
}