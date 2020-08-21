<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\Contact;
use Bigoen\Parasut\Model\ContactDebitTransactionInput;
use Bigoen\Parasut\Model\ContactDebitTransactionOutput;
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
    public function getContact(int $id): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("contacts/{$id}"),
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
    public function getObjectContact(int $id): ?Contact
    {
        return Contact::new($this->getContact($id));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postContact(array $data): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('contacts'),
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
    public function postObjectContact(Contact $contact): ?Contact
    {
        return Contact::new($this->postContact($contact->toArray()));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putContact(int $id, array $data): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("contacts/{$id}"),
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
    public function putObjectContact(Contact $contact): ?Contact
    {
        return Contact::new($this->putContact($contact->id, $contact->toArray()));
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
    public function postContactDebitTransaction(int $contactId, array $data): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl("contacts/{$contactId}/contact_debit_transactions"),
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
    public function postObjectContactDebitTransaction(ContactDebitTransactionInput $input): ?ContactDebitTransactionOutput
    {
        return ContactDebitTransactionOutput::new(
            $this->postContactDebitTransaction($input->contactId, $input->toArray())
        );
    }
}
