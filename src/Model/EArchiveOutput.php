<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EArchiveOutput
{
    use ObjectTrait;

    public ?string $id = null;
    public ?string $uuid = null;
    public ?string $vkn = null;
    public ?string $invoiceNumber = null;
    public ?string $note = null;
    public ?string $isPrinted = null;
    public ?string $status = null;
    public ?DateTimeInterface $printedAt = null;
    public ?DateTimeInterface $cancellableUntil = null;
    public ?bool $isSigned = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?array $relationships = null;
    public ?array $meta = null;
    public ?array $included = null;

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
        $object->uuid = $attributes['uuid'];
        $object->vkn = $attributes['vkn'];
        $object->invoiceNumber = $attributes['invoice_number'];
        $object->note = $attributes['note'];
        $object->isPrinted = $attributes['is_printed'];
        $object->status = $attributes['status'];
        $object->printedAt = self::createDateTime($attributes['printed_at']);
        $object->cancellableUntil = self::createDateTime($attributes['cancellable_until']);
        $object->isSigned = $attributes['is_signed'];
        $object->createdAt = self::createDateTime($attributes['created_at'], 'Y-m-d');
        $object->updatedAt = self::createDateTime($attributes['updated_at'], 'Y-m-d');
        // set relationships.
        $object->relationships = $attributes['relationships'];
        $object->meta = $attributes['meta'];
        // set included.
        if (isset($arr['included'])) {
            $object = RelationshipsConverter::newFromObject($object, $arr);
        }

        return $object;
    }
}
