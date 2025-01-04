<?php

namespace App\Helpers;

use NumberFormatter;
    // كلاس لاستجاع شكل العملة ماخوذ من ملف config
class Currency
{
    //غي حال تم استدعاء الكلاس  ك فنكشن يتم استخدام فنكشن __invoke
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }

    public static function format($amount,$currency=null)
    {
        $formatter =new NumberFormatter(config('app.locale'),NumberFormatter::CURRENCY);
        if($currency === null){
            $currency = config('app.currency','USD');
        }
        return $formatter->formatCurrency($amount,$currency);
    }
}

