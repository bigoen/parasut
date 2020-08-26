<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class PaymentItemTypeConstant
{
    const PURCHASE_BILL = 'purchase_bill';
    const CANCELLED = 'cancelled';
    const RECURRING_PURCHASE_BILL = 'recurring_purchase_bill';
    const REFUND = 'refund';
    const INVOICE = 'invoice';
    const ESTIMATE = 'estimate';
    const RECURRING_INVOICE = 'recurring_invoice';
    const RECURRING_ESTIMATE = 'recurring_estimate';

    public static function getTypes(): array
    {
        return [
            self::PURCHASE_BILL,
            self::CANCELLED,
            self::RECURRING_PURCHASE_BILL,
            self::REFUND,
            self::INVOICE,
            self::ESTIMATE,
            self::RECURRING_INVOICE,
            self::RECURRING_ESTIMATE,
        ];
    }
}
