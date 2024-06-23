<?php

namespace App\Helper;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NumberFormatter;

class Currency
{
    // use class as function
    public function __invoke(...$params) //args
    {
        return static::format(...$params); //arr to arg
    }

    public static function format($amount)
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        $currency = null;

        $BaseCurrency = config('app.currency', 'USD');

        if ($currency = null) {
            $currency = Session::get('currency_code', $BaseCurrency);
        }

        if ($currency != $BaseCurrency) {
            $rate = Cache::get('currency_rate_' . $currency, 1);

            $amount = $amount * $rate;
        }

        // if (config('app.locale') === 'en') {
        //     $currency = "EGP";
        // }
        // if (config('app.locale') === 'ar') {
        //     $currency = "EGP";
        // }
        return $formatter->formatCurrency($amount, $currency);
    }
}