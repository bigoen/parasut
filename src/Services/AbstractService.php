<?php

declare(strict_types=1);

namespace Bigoen\Parasut\Services;

use DateTime;
use DateTimeInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\CacheItem;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Cache\InvalidArgumentException;

/**
 * @author Şafak Saylam <safak@bigoen.com>
 */
abstract class AbstractService
{
    const BASE_URL = 'https://api.parasut.com';
    const VERSION = 'v4';

    const CACHE_TOKENS = 'tokens';

    const ACCESS_TOKEN = 'access_token';
    const REFRESH_TOKEN = 'refresh_token';

    protected string $accessToken;
    protected string $refreshToken;
    protected bool $throw = false;

    protected string $clientId;
    protected string $clientSecret;
    protected string $email;
    protected string $password;
    protected string $companyId;
    protected string $redirectUri;

    protected HttpClientInterface $httpClient;
    protected CacheInterface $cache;

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $clientId,
        string $clientSecret,
        string $email,
        string $password,
        string $companyId,
        HttpClientInterface $httpClient,
        ?CacheInterface $cache = null
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->email = $email;
        $this->password = $password;
        $this->redirectUri = 'urn:ietf:wg:oauth:2.0:oob';
        $this->companyId = $companyId;
        // classes create or set.
        $this->httpClient = $httpClient;
        $this->cache = $cache ?? new FilesystemAdapter();
        // set token.
        $this->setTokens();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws InvalidArgumentException
     */
    public function setTokens(): void
    {
        $tokens = $this->cache->getItem(self::CACHE_TOKENS);
        if (!$tokens instanceof CacheItem) {
            return;
        }
        $value = $tokens->get();
        if (is_null($value)) {
            $response = $this->loginAction();
            $tokens->set($response)->expiresAt(self::createExpiresAt($response['expires_in']));
            $this->cache->save($tokens);
            $value = $response;
        }
        $this->accessToken = $value[self::ACCESS_TOKEN];
        $this->refreshToken = $value[self::REFRESH_TOKEN];
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function loginAction(): array
    {
        return $this->httpClient->request('POST', self::BASE_URL.'/oauth/token', [
            'json' => [
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'password',
                'username' => $this->email,
                'password' => $this->password,
                'redirect_uri' => $this->redirectUri,
            ]
        ])->toArray();
    }

    protected function createUrl(string $path): string
    {
        return self::BASE_URL.'/'.self::VERSION.'/'.$this->companyId.'/'.$path;
    }

    protected static function createExpiresAt(int $seconds): ?DateTimeInterface
    {
        return (new DateTime())->modify("+{$seconds} seconds");
    }

    public function trueThrow(): self
    {
        $this->throw = true;

        return $this;
    }
}
