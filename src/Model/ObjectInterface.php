<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
interface ObjectInterface
{
    public function toArray(): array;
    public static function new(array $arr): ?self;
}
