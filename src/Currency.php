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

    public static function convert(string $from, string $to, float $amount = 1)
    {
        $from_price = 0;
        $from_price_nbu_buy = 0;
        $from_price_nbu_sell = 0;

        $to_price = 1;
        $to_price_nbu_buy = 1;
        $to_price_nbu_sell = 1;

        foreach (self::getJson() as $item) {
            $code = strtolower($item->code);

            if ($code == strtolower($from)) {
                $from_price = $item->cb_price;
                $from_price_nbu_buy = $item->nbu_buy_price;
                $from_price_nbu_sell = $item->nbu_cell_price;
            }

            if ($code == strtolower($to)) {
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

    public const AED = 'AED';
    public const AUD = 'AUD';
    public const CAD = 'CAD';
    public const CHF = 'CHF';
    public const CNY = 'CNY';
    public const DKK = 'DKK';
    public const EGP = 'EGP';
    public const EUR = 'EUR';
    public const GBP = 'GBP';
    public const ISK = 'ISK';
    public const JPY = 'JPY';
    public const KRW = 'KRW';
    public const KWD = 'KWD';
    public const KZT = 'KZT';
    public const LBP = 'LBP';
    public const MYR = 'MYR';
    public const NOK = 'NOK';
    public const PLN = 'PLN';
    public const RUB = 'RUB';
    public const SEK = 'SEK';
    public const SGD = 'SGD';
    public const TRY = 'TRY';
    public const UAH = 'UAH';
    public const USD = 'USD';
    public const UZS = 'UZS';
}