<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTime;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
trait ObjectTrait
{
    public ?array $errors = null;

    public static function clearToArray(array $arr): array
    {
        foreach ($arr as $key => $value) {
            if (is_null($value)) {
                unset($arr[$key]);
            } elseif ('attributes' === $key) {
                foreach ($value as $key2 => $attribute) {
                    if (is_null($attribute)) {
                        unset($arr[$key][$key2]);
                    }
                }
            }
        }

        return $arr;
    }

    public static function createDateTime(?string $dateTime, string $format = DateTime::RFC3339_EXTENDED): ?DateTimeInterface
    {
        if (!is_string($dateTime)) {
            return null;
        }
        $object = DateTime::createFromFormat($format, $dateTime);

        return $object instanceof DateTimeInterface ? $object : null;
    }
}
