<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class PaymentTypeConstant
{
    const SALES_INVOICES = 'sales_invoices';
    const PURCHASE_BILLS = 'purchase_bills';
    const TAXES = 'taxes';
    const BANK_FEES = 'bank_fees';
    const SALARIES = 'salaries';
    const CHECKS = 'checks';
    const TRANSACTIONS = 'transactions';

    public static function getTypes(): array
    {
        return [
            self::SALES_INVOICES,
            self::PURCHASE_BILLS,
            self::TAXES,
            self::BANK_FEES,
            self::SALARIES,
            self::CHECKS,
            self::TRANSACTIONS,
        ];
    }
}
