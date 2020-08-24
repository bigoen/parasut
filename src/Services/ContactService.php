<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\Contact;
use Bigoen\Parasut\Model\ContactTransactionInput;
use Bigoen\Parasut\Model\ContactTransactionOutput;
use Bigoen\Parasut\Model\Pagination;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class ContactService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getContacts(array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl('contacts'),
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
    public function getObjectContacts(array $queries = []): Pagination
    {
        return Pagination::new($this->getContacts($queries), Contact::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getContact(int $id, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("contacts/{$id}"),
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
    public function getObjectContact(int $id, ?string $includeQueries = null): ?Contact
    {
        return Contact::new($this->getContact($id, $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postContact(array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('contacts'),
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
    public function postObjectContact(Contact $contact, ?string $includeQueries = null): ?Contact
    {
        return Contact::new($this->postContact($contact->toArray(), $includeQueries));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putContact(int $id, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("contacts/{$id}"),
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
    public function putObjectContact(Contact $contact, ?string $includeQueries = null): ?Contact
    {
        return Contact::new($this->putContact($contact->id, $contact->toArray(), $includeQueries));
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function deleteContact(int $id): bool
    {
        return 204 === $this->httpClient->request(
            'DELETE',
            $this->createUrl("contacts/{$id}"),
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
    public function postContactDebitTransaction(int $contactId, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl("contacts/{$contactId}/contact_debit_transactions"),
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
    public function postObjectContactDebitTransaction(ContactTransactionInput $input, ?string $includeQueries = null): ?ContactTransactionOutput
    {
        return ContactTransactionOutput::new(
            $this->postContactDebitTransaction($input->contactId, $input->toArray(), $includeQueries)
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postContactCreditTransaction(int $contactId, array $data, ?string $includeQueries = null): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl("contacts/{$contactId}/contact_credit_transactions"),
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
    public function postObjectContactCreditTransaction(ContactTransactionInput $input, ?string $includeQueries = null): ?ContactTransactionOutput
    {
        return ContactTransactionOutput::new(
            $this->postContactCreditTransaction($input->contactId, $input->toArray(), $includeQueries)
        );
    }
}
