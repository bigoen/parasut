<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class DiscountTypeConstant
{
    const PERCENTAGE = 'percentage';
    const AMOUNT = 'amount';

    public static function getTypes(): array
    {
        return [
            self::PERCENTAGE,
            self::AMOUNT,
        ];
    }
}
