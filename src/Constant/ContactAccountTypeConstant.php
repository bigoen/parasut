<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ContactAccountTypeConstant
{
    const CUSTOMER = 'customer';
    const SUPPLIER = 'supplier';

    public static function getTypes(): array
    {
        return [
            self::CUSTOMER,
            self::SUPPLIER,
        ];
    }
}
