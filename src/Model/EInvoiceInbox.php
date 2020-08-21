<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceInbox
{
    use ObjectTrait;

    public ?string $id = null;
    public ?string $vkn = null;
    public ?string $eInvoiceAddress = null;
    public ?string $name = null;
    public ?string $inboxType = null;
    public ?DateTimeInterface $addressRegisteredAt = null;
    public ?DateTimeInterface $registeredAt = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?array $relationships = null;
    public ?array $meta = null;

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
        $object->vkn = $attributes['vkn'];
        $object->eInvoiceAddress = $attributes['e_invoice_address'];
        $object->name = $attributes['name'];
        $object->inboxType = $attributes['inbox_type'];
        $object->addressRegisteredAt = self::createDateTime($attributes['address_registered_at']);
        $object->registeredAt = self::createDateTime($attributes['registered_at']);
        $object->createdAt = self::createDateTime($attributes['created_at'], 'Y-m-d');
        $object->updatedAt = self::createDateTime($attributes['updated_at'], 'Y-m-d');
        // set relationships.
        $object->relationships = $attributes['relationships'];
        $object->meta = $attributes['meta'];

        return $object;
    }
}
