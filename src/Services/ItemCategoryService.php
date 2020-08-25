<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\ItemCategory;
use Bigoen\Parasut\Model\Pagination;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ItemCategoryService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getItemCategories(array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl('item_categories'),
            [
                'query' => $queries,
                'auth_bearer' => $this->accessToken,
            ]
        )->toArray($this->throw);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getObjectItemCategories(array $queries): Pagination
    {
        return Pagination::new($this->getItemCategories($queries), ItemCategory::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getItemCategory(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("item_categories/{$id}"),
            [
                'query' => [
                    'include' => $includeQueries,
                ],
                'auth_bearer' => $this->accessToken,
            ]
        )->toArray($this->throw);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getObjectItemCategory(int $id, ?string $includeQueries = null): ?ItemCategory
    {
        return ItemCategory::new($this->getItemCategory($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postItemCategory(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('item_categories'),
            [
                'query' => [
                    'include' => $includeQueries,
                ],
                'json' => [
                    'data' => $data,
                ],
                'auth_bearer' => $this->accessToken,
            ]
        )->toArray($this->throw);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postObjectItemCategory(ItemCategory $itemCategory, ?string $includeQueries = null): ?ItemCategory
    {
        return ItemCategory::new($this->postItemCategory($itemCategory->toArray(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putItemCategory(int $id, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("item_categories/{$id}"),
            [
                'query' => [
                    'include' => $includeQueries,
                ],
                'json' => [
                    'data' => $data,
                ],
                'auth_bearer' => $this->accessToken,
            ]
        )->toArray($this->throw);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putObjectItemCategory(ItemCategory $itemCategory, ?string $includeQueries = null): ?ItemCategory
    {
        return ItemCategory::new($this->putItemCategory($itemCategory->id, $itemCategory->toArray(), $includeQueries));
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function deleteItemCategory(int $id): bool
    {
        return 204 === $this->httpClient->request(
            'DELETE',
                $this->createUrl("item_categories/{$id}"),
                [
                    'auth_bearer' => $this->accessToken,
                ]
            )->getStatusCode();
    }
}
