<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Constant;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceStatusConstant
{
    const WAITING = 'waiting';
    const FAILED = 'failed';
    const SUCCESSFUL = 'successful';

    public static function getStatus(): array
    {
        return [
            self::WAITING,
            self::FAILED,
            self::SUCCESSFUL,
        ];
    }
}
