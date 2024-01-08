<?php

namespace AreaWeb\LaravelPackage;

use Illuminate\Support\Facades\Http;

class Currency
{
    private static function getJson()
    {
        $response = Http::get('https://nbu.uz/exchange-rates/json/');
        return $response->body();
    }

    public static function convert($from, $to)
    {
        return self::getJson();
    }
}