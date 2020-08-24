<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\EArchiveInput;
use Bigoen\Parasut\Model\EArchiveOutput;
use Bigoen\Parasut\Model\EArchiveShowPdf;
use Bigoen\Parasut\Model\EInvoiceInbox;
use Bigoen\Parasut\Model\EInvoiceInput;
use Bigoen\Parasut\Model\EInvoiceOutput;
use Bigoen\Parasut\Model\EInvoiceShowPdf;
use Bigoen\Parasut\Model\Pagination;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class EInvoiceService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getEInvoiceInbox(array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl('e_invoice_inboxes'),
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
    public function getObjectEInvoiceInbox(array $queries = []): Pagination
    {
        return Pagination::new($this->getEInvoiceInbox($queries), EInvoiceInbox::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postEArchive(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('e_archives'),
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
    public function postObjectEArchive(EArchiveInput $input, ?string $includeQueries = null): ?EArchiveOutput
    {
        return EArchiveOutput::new($this->postEArchive($input->toArray(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getEArchive(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("e_archives/{$id}"),
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
    public function getObjectEArchive(int $id, ?string $includeQueries = null): ?EArchiveOutput
    {
        return EArchiveOutput::new($this->getEArchive($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getEArchiveShowPdf(int $id): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("e_archives/{$id}/pdf"),
            [
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
    public function getObjectEArchiveShowPdf(int $id): ?EArchiveShowPdf
    {
        return EArchiveShowPdf::new($this->getEArchiveShowPdf($id));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postEInvoice(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('e_invoices'),
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
    public function postObjectEInvoice(EInvoiceInput $input, ?string $includeQueries = null): ?EInvoiceOutput
    {
        return EInvoiceOutput::new($this->postEInvoice($input->toArray(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getEInvoice(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("e_invoices/{$id}"),
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
    public function getObjectEInvoice(int $id, ?string $includeQueries = null): ?EInvoiceOutput
    {
        return EInvoiceOutput::new($this->getEInvoice($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getEInvoiceShowPdf(int $id): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("e_invoices/{$id}/pdf"),
            [
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
    public function getObjectEInvoiceShowPdf(int $id): ?EInvoiceShowPdf
    {
        return EInvoiceShowPdf::new($this->getEInvoiceShowPdf($id));
    }
}
