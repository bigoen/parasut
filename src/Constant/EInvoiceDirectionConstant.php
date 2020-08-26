<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceDirectionConstant
{
    const INBOUND = 'inbound';
    const OUTBOUND = 'outbound';

    public static function getDirections(): array
    {
        return [
            self::INBOUND,
            self::OUTBOUND,
        ];
    }
}
