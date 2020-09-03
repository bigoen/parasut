<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use Bigoen\Parasut\Model\Account;
use Bigoen\Parasut\Model\AccountTransaction;
use Bigoen\Parasut\Model\AccountTransactionInput;
use Bigoen\Parasut\Model\Pagination;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
class AccountService extends AbstractService
{
    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getAccounts(array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl('accounts'),
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
    public function getObjectAccounts(array $queries = []): Pagination
    {
        return Pagination::new($this->getAccounts($queries), Account::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getAccount(int $id): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("accounts/{$id}"),
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
    public function getObjectAccount(int $id): ?Account
    {
        return Account::new($this->getAccount($id));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postAccount(array $data): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl('accounts'),
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
    public function postObjectAccount(Account $account): ?Account
    {
        return Account::new($this->postAccount($account->toArray()));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function putAccount(int $id, array $data): array
    {
        return $this->httpClient->request(
            'PUT',
            $this->createUrl("accounts/{$id}"),
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
    public function putObjectAccount(Account $account): ?Account
    {
        return Account::new($this->putAccount($account->id, $account->toArray()));
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function deleteAccount(int $id): bool
    {
        return 204 === $this->httpClient->request(
            'DELETE',
                $this->createUrl("accounts/{$id}"),
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
    public function getTransactions(int $accountId, array $queries = []): array
    {
        return $this->httpClient->request(
            'GET',
            $this->createUrl("accounts/{$accountId}/transactions"),
            [
                'query' => $queries,
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
    public function getObjectTransactions(int $accountId, array $queries = []): Pagination
    {
        return Pagination::new($this->getTransactions($accountId, $queries), AccountTransaction::class);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postDebitTransaction(int $accountId, array $data): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl("accounts/{$accountId}/debit_transactions"),
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
    public function postObjectDebitTransaction(int $accountId, AccountTransactionInput $input): AccountTransaction
    {
        return AccountTransaction::new($this->postDebitTransaction($accountId, $input->toArray()));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function postCreditTransaction(int $accountId, array $data): array
    {
        return $this->httpClient->request(
            'POST',
            $this->createUrl("accounts/{$accountId}/credit_transactions"),
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
    public function postObjectCreditTransaction(int $accountId, AccountTransactionInput $input): AccountTransaction
    {
        return AccountTransaction::new($this->postCreditTransaction($accountId, $input->toArray()));
    }
}
