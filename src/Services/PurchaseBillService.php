<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\Pagination;
use Bigoen\Parasut\Model\PurchaseBill;
use Bigoen\Parasut\Model\PurchaseBillPayment;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class PurchaseBillService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getPurchaseBills(array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl('purchase_bills'),
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
    public function getObjectPurchaseBills(array $queries = []): Pagination
    {
        return Pagination::new($this->getPurchaseBills($queries), PurchaseBill::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getPurchaseBill(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("purchase_bills/{$id}"),
            [
                'query' => [
                    'include' => $includeQueries,
                ],
                'auth_bearer' => $this->accessToken,
            ],
        )->toArray($this->throw);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getObjectPurchaseBill(int $id, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new($this->getPurchaseBill($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postPurchaseBillBasic(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('purchase_bills#basic'),
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
    public function postPurchaseBillDetailed(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('purchase_bills#detailed'),
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
    public function postObjectPurchaseBillBasic(PurchaseBill $purchaseBill, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new($this->postPurchaseBillBasic($purchaseBill->toArrayBasic(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postObjectPurchaseBillDetailed(PurchaseBill $purchaseBill, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new($this->postPurchaseBillDetailed($purchaseBill->toArray(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putPurchaseBillBasic(int $id, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("purchase_bills/{$id}#basic"),
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
    public function putPurchaseBillDetailed(int $id, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("purchase_bills/{$id}#detailed"),
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
    public function putObjectPurchaseBillBasic(PurchaseBill $purchaseBill, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new(
            $this->putPurchaseBillBasic($purchaseBill->id, $purchaseBill->toArrayBasic(), $includeQueries)
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putObjectPurchaseBillDetailed(PurchaseBill $purchaseBill, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new(
            $this->putPurchaseBillDetailed($purchaseBill->id, $purchaseBill->toArray(), $includeQueries)
        );
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function deletePurchaseBill(int $id): bool
    {
        return 204 === $this->httpClient->request(
            'DELETE',
                $this->createUrl("purchase_bills/{$id}"),
                [
                    'auth_bearer' => $this->accessToken,
                ]
            )->getStatusCode();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postPurchaseBillPayment(int $purchaseBillId, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl("purchase_bills/{$purchaseBillId}/payments"),
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
    public function postObjectPurchaseBillPayment(PurchaseBillPayment $payment, ?string $includeQueries = null): ?PurchaseBillPayment
    {
        return PurchaseBillPayment::new(
            $this->postPurchaseBillPayment($payment->salesInvoiceId, $payment->toArray(), $includeQueries)
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function cancelPurchaseBill(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
                'DELETE',
                $this->createUrl("purchase_bills/{$id}/cancel"),
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
    public function cancelObjectPurchaseBill(int $id, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new($this->cancelPurchaseBill($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function recoverPurchaseBill(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PATCH',
            $this->createUrl("purchase_bills/{$id}/recover"),
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
    public function recoverObjectPurchaseBill(int $id, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new($this->recoverPurchaseBill($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function archivePurchaseBill(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PATCH',
            $this->createUrl("purchase_bills/{$id}/archive"),
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
    public function archiveObjectPurchaseBill(int $id, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new($this->archivePurchaseBill($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function unArchivePurchaseBill(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PATCH',
            $this->createUrl("purchase_bills/{$id}/unarchive"),
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
    public function unArchiveObjectPurchaseBill(int $id, ?string $includeQueries = null): ?PurchaseBill
    {
        return PurchaseBill::new($this->unArchivePurchaseBill($id, $includeQueries));
    }
}
