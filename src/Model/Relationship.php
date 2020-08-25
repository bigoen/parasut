<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Relationship implements ObjectInterface
{
    use ObjectTrait;

    const FILTERS_DETAIL_RELATIONS = [
        'sales_invoice_details',
        'purchase_bill_details',
    ];

    public ?int $id = null;
    public ?string $type = null;
    public ?array $attributes = null;
    public ?array $relationships = null;
    public ?array $meta = null;

    public static function new(array $arr): ?self
    {
        if (isset($arr['data'])) {
            $arr = $arr['data'];
        }
        if (!isset($arr['id'], $arr['type'])) {
            return null;
        }
        $object = new self();
        $object->id = (int) $arr['id'];
        $object->type = $arr['type'];
        $object->attributes = $arr['attributes'] ?? [];
        $object->relationships = $arr['relationships'] ?? [];
        $object->meta = $arr['meta'] ?? [];

        return $object;
    }

    public function toArray(): array
    {
        if (in_array($this->type, self::FILTERS_DETAIL_RELATIONS)) {
            return [
                'id' => $this->id,
                'type' => $this->type,
                'attributes' => $this->attributes,
                'relationships' => $this->relationships,
            ];
        }

        return [
            'id' => $this->id,
            'type' => $this->type,
        ];
    }
}
