<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class PaymentStatusConstant
{
    const PAID = 'paid';
    const OVERDUE = 'overdue';
    const UNPAID = 'unpaid';
    const PARTIALLY_PAID = 'partially_paid';

    public static function getStatus(): array
    {
        return [
            self::PAID,
            self::OVERDUE,
            self::UNPAID,
            self::PARTIALLY_PAID,
        ];
    }
}
