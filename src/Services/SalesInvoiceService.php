<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\Pagination;
use Bigoen\Parasut\Model\SalesInvoice;
use Bigoen\Parasut\Model\SalesInvoicePayment;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class SalesInvoiceService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getSalesInvoices(array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl('sales_invoices'),
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
    public function getObjectSalesInvoices(array $queries = []): Pagination
    {
        return Pagination::new($this->getSalesInvoices($queries), SalesInvoice::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getSalesInvoice(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("sales_invoices/{$id}"),
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
    public function getObjectSalesInvoice(int $id, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new($this->getSalesInvoice($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postSalesInvoice(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('sales_invoices'),
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
    public function postObjectSalesInvoice(SalesInvoice $salesInvoice, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new($this->postSalesInvoice($salesInvoice->toArray(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putSalesInvoice(int $id, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("sales_invoices/{$id}"),
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
    public function putObjectSalesInvoice(SalesInvoice $salesInvoice, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new($this->putSalesInvoice($salesInvoice->id, $salesInvoice->toArray(), $includeQueries));
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function deleteSalesInvoice(int $id): bool
    {
        return 204 === $this->httpClient->request(
            'DELETE',
                $this->createUrl("sales_invoices/{$id}"),
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
    public function postSalesInvoicePayment(int $salesInvoiceId, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl("sales_invoices/{$salesInvoiceId}/payments"),
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
    public function postObjectSalesInvoicePayment(SalesInvoicePayment $payment, ?string $includeQueries = null): ?SalesInvoicePayment
    {
        return SalesInvoicePayment::new(
            $this->postSalesInvoicePayment($payment->salesInvoiceId, $payment->toArray(), $includeQueries)
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function cancelSalesInvoice(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
                'DELETE',
                $this->createUrl("sales_invoices/{$id}/cancel"),
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
    public function cancelObjectSalesInvoice(int $id, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new($this->cancelSalesInvoice($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function recoverSalesInvoice(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PATCH',
            $this->createUrl("sales_invoices/{$id}/recover"),
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
    public function recoverObjectSalesInvoice(int $id, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new($this->recoverSalesInvoice($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function archiveSalesInvoice(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PATCH',
            $this->createUrl("sales_invoices/{$id}/archive"),
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
    public function archiveObjectSalesInvoice(int $id, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new($this->archiveSalesInvoice($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function unArchiveSalesInvoice(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PATCH',
            $this->createUrl("sales_invoices/{$id}/unarchive"),
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
    public function unArchiveObjectSalesInvoice(int $id, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new($this->unArchiveSalesInvoice($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function convertEstimateToSalesInvoice(int $id, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PATCH',
            $this->createUrl("sales_invoices/{$id}/convert_to_invoice"),
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
    public function convertEstimateToObjectSalesInvoice(SalesInvoice $salesInvoice, ?string $includeQueries = null): ?SalesInvoice
    {
        return SalesInvoice::new(
            $this->convertEstimateToSalesInvoice($salesInvoice->id, $salesInvoice->toArray(), $includeQueries)
        );
    }
}
