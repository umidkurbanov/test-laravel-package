<?php

namespace UmidPackage;

use Carbon\Carbon;

class ResovaApiClient
{
    public function getTime()
    {
        return Carbon::now();
    }
}