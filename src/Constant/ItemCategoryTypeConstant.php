<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ItemCategoryTypeConstant
{
    const PRODUCT = 'Product';
    const CONTACT = 'Contact';
    const EMPLOYEE = 'Employee';
    const SALES_INVOICE = 'SalesInvoice';
    const EXPENDITURE = 'Expenditure';

    public static function getTypes(): array
    {
        return [
            self::PRODUCT,
            self::CONTACT,
            self::EMPLOYEE,
            self::SALES_INVOICE,
            self::EXPENDITURE,
        ];
    }
}
