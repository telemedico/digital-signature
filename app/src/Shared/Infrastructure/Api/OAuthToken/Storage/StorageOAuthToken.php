<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\OAuthToken\Storage;

use App\Shared\Infrastructure\Api\Client\ClientOAuthTokenInterface;
use App\Shared\Infrastructure\Api\OAuthToken\OAuthToken;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpKernel\KernelInterface;

class StorageOAuthToken
{
    private ?FilesystemAdapter $cache = null;
    private ClientOAuthTokenInterface $client;
    private KernelInterface $kernel;

    public function __construct(ClientOAuthTokenInterface $client, KernelInterface $kernel)
    {
        $this->client = $client;
        $this->kernel = $kernel;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function token(string $name): OAuthToken
    {
        if ($this->isValid($name)) {
            return $this->tokenFromCache($name);
        }

        return $this->tokenFromOauth($name);
    }

    private function isValid(string $name): bool
    {
        $OAuthToken = $this->tokenFromCache($name);

        return $OAuthToken instanceof OAuthToken
               && false === $OAuthToken->isExpired()
        ;
    }

    private function tokenFromCache(string $name): ?OAuthToken
    {
        try {
            return $this->cache()->getItem($name)->get();
        } catch (InvalidArgumentException $invalidArgumentException) {
            return null;
        }
    }

    /**
     * @throws InvalidArgumentException
     */
    private function tokenFromOauth(string $name): OAuthToken
    {
        $token = $this->client->token();

        $this->saveToCache($name, $token);

        return $token;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function saveToCache(string $name, OAuthToken $OAuthToken): void
    {
        $cacheItem = $this
            ->cache()
            ->getItem($name)
            ->set($OAuthToken)
            ->expiresAt($OAuthToken->expiresAt())
        ;

        $this->cache()->save($cacheItem);
    }

    private function cache(): FilesystemAdapter
    {
        if ($this->cache instanceof FilesystemAdapter) {
            return $this->cache;
        }

        return $this->cache = new FilesystemAdapter(
            'OAUTH_TOKENS',
            0,
            $this->kernel->getCacheDir()
        );
    }
}
