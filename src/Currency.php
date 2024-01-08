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

    public static function convert(string $from, string $to, float $amount)
    {
        $from_price = 0;
        $from_price_nbu_buy = 0;
        $from_price_nbu_sell = 0;

        $to_price = 1;
        $to_price_nbu_buy = 1;
        $to_price_nbu_sell = 1;

        foreach (self::getJson() as $item) {
            $code = strtolower($item->code);

            if ($code == $from) {
                $from_price = $item->cb_price;
                $from_price_nbu_buy = $item->nbu_buy_price;
                $from_price_nbu_sell = $item->nbu_cell_price;
            }

            if ($code == $to) {
                $to_price = $item->cb_price;
                $to_price_nbu_buy = $item->nbu_buy_price;
                $to_price_nbu_sell = $item->nbu_cell_price;
            }
        }

        return [
            'cb_price' => number_format(($from_price * $amount) / $to_price, 2, '.', ' '),
            'nbu_buy_price' => number_format(($from_price_nbu_buy * $amount) / $to_price_nbu_buy, 2, '.', ' '),
            'nbu_cell_price' => number_format(($from_price_nbu_sell * $amount) / $to_price_nbu_sell, 2, '.', ' '),
        ];
    }
}