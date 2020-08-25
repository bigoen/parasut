<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

use DateTimeInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceOutput
{
    use ObjectTrait;

    public ?string $id = null;
    public ?string $externalId = null;
    public ?string $uuid = null;
    public ?string $envUuid = null;
    public ?string $fromAddress = null;
    public ?string $fromVkn = null;
    public ?string $toAddress = null;
    public ?string $toVkn = null;
    public ?string $direction = null;
    public ?string $note = null;
    public ?string $responseType = null;
    public ?string $contactName = null;
    public ?string $scenario = null;
    public ?string $status = null;
    public ?DateTimeInterface $issueDate = null;
    public ?bool $isExpired = null;
    public ?bool $isAnswerable = null;
    public ?float $netTotal = null;
    public ?string $currency = null;
    public ?string $itemType = null;
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
        $object->externalId = $attributes['external_id'];
        $object->uuid = $attributes['uuid'];
        $object->envUuid = $attributes['env_uuid'];
        $object->fromAddress = $attributes['from_address'];
        $object->fromVkn = $attributes['from_vkn'];
        $object->toAddress = $attributes['to_address'];
        $object->toVkn = $attributes['to_vkn'];
        $object->direction = $attributes['direction'];
        $object->note = $attributes['note'];
        $object->responseType = $attributes['response_type'];
        $object->contactName = $attributes['contact_name'];
        $object->scenario = $attributes['scenario'];
        $object->status = $attributes['status'];
        $object->issueDate = self::createDateTime($attributes['issue_date'], 'Y-m-d');
        $object->isExpired = $attributes['is_expired'];
        $object->isAnswerable = $attributes['is_answerable'];
        $object->netTotal = $attributes['net_total'];
        $object->currency = $attributes['currency'];
        $object->itemType = $attributes['item_type'];
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
