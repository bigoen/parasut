<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\Product;
use Bigoen\Parasut\Model\Pagination;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ProductService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getProducts(array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl('products'),
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
    public function getObjectProducts(array $queries = []): Pagination
    {
        return Pagination::new($this->getProducts($queries), Product::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getProduct(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("products/{$id}"),
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
    public function getObjectProduct(int $id, ?string $includeQueries = null): ?Product
    {
        return Product::new($this->getProduct($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postProduct(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('products'),
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
    public function postObjectProduct(Product $product, ?string $includeQueries = null): ?Product
    {
        return Product::new($this->postProduct($product->toArray(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putProduct(int $id, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("products/{$id}"),
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
    public function putObjectProduct(Product $product, ?string $includeQueries = null): ?Product
    {
        return Product::new($this->putProduct($product->id, $product->toArray(), $includeQueries));
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function deleteProduct(int $id): bool
    {
        return 204 === $this->httpClient->request(
            'DELETE',
                $this->createUrl("products/{$id}"),
                [
                    'auth_bearer' => $this->accessToken,
                ]
            )->getStatusCode();
    }
}
