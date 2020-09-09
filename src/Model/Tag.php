<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Contracts\Parasut\Constant\DataTypeConstant;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Tag implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $name = null;
    public ?string $safeName = null;
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
        $object->id = (int) $data['id'];
        // attributes.
        $attributes = $data['attributes'];
        $object->createdAt = self::createDateTime($attributes['created_at']);
        $object->updatedAt = self::createDateTime($attributes['updated_at']);
        $object->name = $attributes['name'];
        $object->safeName = $attributes['safe_name'];
        $object->meta = $data['meta'];

        return $object;
    }

    public function toArray(): array
    {
        return self::clearToArray([
            'id' => $this->id,
            'type' => DataTypeConstant::TAGS,
            'attributes' => [
                'name' => $this->name,
            ],
        ]);
    }
}
