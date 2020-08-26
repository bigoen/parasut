<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class CurrencyConstant
{
    const TRL = 'TRL';
    const USD = 'USD';
    const EUR = 'EUR';
    const GBP = 'GBP';

    public static function getCurrencies(): array
    {
        return [
            self::TRL,
            self::USD,
            self::EUR,
            self::GBP,
        ];
    }
}
