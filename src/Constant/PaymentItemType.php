<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class PaymentItemType
{
    const PURCHASE_BILL = 'purchase_bill';
    const CANCELLED = 'cancelled';
    const RECURRING_PURCHASE_BILL = 'recurring_purchase_bill';
    const REFUND = 'refund';
    const INVOICE = 'invoice';
    const ESTIMATE = 'estimate';
    const RECURRING_INVOICE = 'recurring_invoice';
    const RECURRING_ESTIMATE = 'recurring_estimate';
}
