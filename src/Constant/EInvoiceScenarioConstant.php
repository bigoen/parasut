<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceScenarioConstant
{
    const BASIC = 'basic';
    const COMMERCIAL = 'commercial';

    public static function getScenarios(): array
    {
        return [
            self::BASIC,
            self::COMMERCIAL,
        ];
    }
}
