<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ContactTypeConstant
{
    const PERSON = 'person';
    const COMPANY = 'company';

    public static function getTypes(): array
    {
        return [
            self::PERSON,
            self::COMPANY,
        ];
    }
}
