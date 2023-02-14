<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\Client;

use App\Shared\Infrastructure\Api\Client\Guzzle\LoggingGuzzleClient;
use App\Shared\Infrastructure\Api\OAuthToken\Storage\StorageFactoryOAuthToken;
use App\Shared\Infrastructure\Api\Response\ExternalResponseInterface;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

abstract class AbstractApiClient
{
    private ?LoggingGuzzleClient $client = null;
    private LoggerInterface $integrationLogger;
    private StorageFactoryOAuthToken $storageFactoryOAuthToken;

    public function __construct(
        LoggerInterface $integrationLogger,
        StorageFactoryOAuthToken $storageFactoryOAuthToken
    ) {
        $this->integrationLogger = $integrationLogger;
        $this->storageFactoryOAuthToken = $storageFactoryOAuthToken;
    }

    protected function client(): LoggingGuzzleClient
    {
        if ($this->client instanceof LoggingGuzzleClient) {
            return $this->client;
        }

        if ($this instanceof ClientOAuthTokenInterface) {
            $client = $this->createClientWithToken();
        } else {
            $client = $this->createClient();
        }

        $this->client = new LoggingGuzzleClient($client, $this->integrationLogger);

        return $this->client;
    }

    private function createClientWithToken(): Client
    {
        if (false === ($this instanceof ClientOAuthTokenInterface)) {
            throw new \Exception(sprintf('Api client must implements interface "%s"', ClientOAuthTokenInterface::class));
        }

        $storageOAuthToken = $this->storageFactoryOAuthToken->create($this);
        $OAuthToken = $storageOAuthToken->token($this->name());

        return new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => sprintf('%s %s', $OAuthToken->tokenType(), $OAuthToken->accessToken())
            ],
            'cookies' => true,
            'verify' => false,
            'timeout' => 10,
        ]);
    }

    private function createClient(): Client
    {
        return new Client([
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'cookies' => true,
            'verify' => false,
        ]);
    }

    abstract public function request(string $method, string $endpoint, array $data = []): ExternalResponseInterface;

    abstract public function name(): string;
}
