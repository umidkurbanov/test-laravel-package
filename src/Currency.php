<?php

namespace AreaWeb\LaravelPackage;

use Illuminate\Support\Facades\Http;

class Currency
{
    private static function getJson()
    {
        $response = Http::get('https://nbu.uz/exchange-rates/json/');
        return json_decode($response->body());
    }

    public static function convert($from, $to)
    {
        $from_price = 1;
        $to_price = 1;

        foreach (self::getJson() as $item) {
            $code = strtolower($item->code);

            if ($code == $from)
                $from_price = $item->cb_price;

            if ($code == $to)
                $to_price = $item->cb_price;
        }

        return $from_price / $to_price;
    }
}