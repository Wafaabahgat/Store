<?php

namespace App\Helper;

use NumberFormatter;

class Currency
{
    // use class as function
    public function __invoke(...$params) //args
    {
        return static::format(...$params); //arr to arg
    }
    
    public static function format($value)
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        $currency = null;
        if (config('app.locale') === 'en') {
            $currency = "EGP";
        }
        if (config('app.locale') === 'ar') {
            $currency = "EGP";
        }
        return $formatter->formatCurrency($value, $currency);
    }
}