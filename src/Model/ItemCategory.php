<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use Bigoen\Contracts\Parasut\Constant\DataTypeConstant;
use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ItemCategory implements ObjectInterface
{
    use ObjectTrait;

    public ?int $id = null;
    public ?int $parentId = null;
    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
    public ?string $categoryType = null;
    public ?string $name = null;
    public ?array $fullPath = null;
    public ?string $bgColor = null;
    public ?string $textColor = null;
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
        $object->id = (int) $data['id'];
        // attributes.
        $attributes = $data['attributes'];
        $object->createdAt = self::createDateTime($attributes['created_at']);
        $object->updatedAt = self::createDateTime($attributes['updated_at']);
        $object->categoryType = $attributes['category_type'];
        $object->name = $attributes['name'];
        $object->fullPath = (array) $attributes['full_path'];
        $object->bgColor = $attributes['bg_color'];
        $object->textColor = $attributes['text_color'];
        // set relationships.
        $object->relationships = $data['relationships'];
        $object->meta = $data['meta'];
        // set included.
        if (isset($arr['included'])) {
            $object = RelationshipsConverter::newFromObject($object, $arr);
        }

        return $object;
    }

    public function toArray(): array
    {
        return self::clearToArray([
            'data' => [
                'id' => $this->id,
                'type' => DataTypeConstant::ITEM_CATEGORIES,
                'attributes' => [
                    'name' => $this->name,
                    'bg_color' => $this->bgColor,
                    'text_color' => $this->textColor,
                    'category_type' => $this->categoryType,
                    'parent_id' => $this->parentId,
                ],
            ],
        ]);
    }
}
