<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceResponseTypeConstant
{
    const ACCEPTED = 'accepted';
    const REJECTED = 'rejected';
    const REFUNDED = 'refunded';

    public static function getTypes(): array
    {
        return [
            self::ACCEPTED,
            self::REJECTED,
            self::REFUNDED,
        ];
    }
}
