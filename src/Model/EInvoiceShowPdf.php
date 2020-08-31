<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceShowPdf
{
    use ObjectTrait;

    public ?string $id = null;
    public ?string $url = null;
    public ?string $expiresAt = null;

    public static function new(array $arr): ?self
    {
        $object = new self();
        if (isset($arr['errors'])) {
            $object->errors = $arr['errors'];

            return $object;
        }
        if (!isset($arr['data']) && !isset($arr['id'])) {
            return null;
        } elseif (isset($arr['id'])) {
            $data = $arr;
        } else {
            $data = $arr['data'];
        }
        $object->id = $data['id'];
        // attributes.
        $attributes = $data['attributes'];
        $object->url = $attributes['url'];
        $object->expiresAt = self::createDateTime($attributes['expires_at']);

        return $object;
    }
}
