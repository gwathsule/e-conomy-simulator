<?php

namespace App\Domains\Indicator;

class Indicator
{
    const PIB = 'pib';
    const UNEMPLOYMENT_TAX = 'unemployment_tax';
    const INFLATION = 'inflation';

    public static function all()
    {
        return [
            self::PIB => __('indicators.' . self::PIB),
            self::UNEMPLOYMENT_TAX => __('indicators.' . self::UNEMPLOYMENT_TAX),
            self::INFLATION => __('indicators.' . self::INFLATION),
        ];
    }
}
