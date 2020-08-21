<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\Pagination;
use Bigoen\Parasut\Model\SalesInvoice;
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
    public function getSalesInvoice(int $id): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("sales_invoices/{$id}"),
            [
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
    public function getObjectSalesInvoice(int $id): ?SalesInvoice
    {
        return SalesInvoice::new($this->getSalesInvoice($id));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postSalesInvoice(array $data): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('sales_invoices'),
            [
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
    public function postObjectSalesInvoice(SalesInvoice $salesInvoice): ?SalesInvoice
    {
        return SalesInvoice::new($this->postSalesInvoice($salesInvoice->toArray()));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putSalesInvoice(int $id, array $data): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("sales_invoices/{$id}"),
            [
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
    public function putObjectSalesInvoice(SalesInvoice $salesInvoice): ?SalesInvoice
    {
        return SalesInvoice::new($this->putSalesInvoice($salesInvoice->id, $salesInvoice->toArray()));
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
}
