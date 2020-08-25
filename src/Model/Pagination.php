<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Model;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class Pagination
{
    public ?array $data = null;
    public ?array $errors = null;
    public ?array $links = null;
    public ?array $meta = null;
    public ?array $included = null;

    public static function new(array $arr, string $className, string $staticNewFunction = 'new'): Pagination
    {
        $object = new self();
        if (isset($arr['errors'])) {
            $object->errors = $arr['errors'];

            return $object;
        }
        $object->data = array_map(fn (array $value) => $className::$staticNewFunction($value), $arr['data']);
        $object->links = $arr['links'];
        $object->meta = $arr['meta'];
        // set included.
        if (isset($arr['included'])) {
            $object = RelationshipsConverter::newFromPagination($object, $arr);
        }

        return $object;
    }

    public function getSelfLink(): ?string
    {
        return $this->links['self'] ?? null;
    }

    public function getNextLink(): ?string
    {
        return $this->links['next'] ?? null;
    }

    public function getLastLink(): ?string
    {
        return $this->links['last'] ?? null;
    }

    public function getCurrentPage(): ?int
    {
        return $this->meta['current_page'] ?? null;
    }

    public function getTotalPages(): ?int
    {
        return $this->meta['total_pages'] ?? null;
    }

    public function getTotalCount(): ?int
    {
        return $this->meta['total_count'] ?? null;
    }

    public function getPerPage(): ?int
    {
        return $this->meta['per_page'] ?? null;
    }

    public function getPayableTotal(): ?float
    {
        return isset($this->meta['payable_total']) ? (float) $this->meta['payable_total'] : null;
    }

    public function getCollectibleTotal(): ?float
    {
        return isset($this->meta['collectible_total']) ? (float) $this->meta['collectible_total'] : null;
    }

    public function getExportUrl(): ?string
    {
        return $this->meta['export_url'] ?? null;
    }
}
