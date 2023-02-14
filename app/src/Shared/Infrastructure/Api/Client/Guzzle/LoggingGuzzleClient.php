<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\Client\Guzzle;

use App\Shared\Infrastructure\Api\Response\DefaultExternalResponse;
use App\Shared\Infrastructure\Api\Response\ExternalResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;
use Throwable;

class LoggingGuzzleClient
{
    private Client $client;
    private LoggerInterface $logger;

    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function client(): Client
    {
        return $this->client;
    }

    public function request(string $method, string $uri = '', array $options = []): ExternalResponseInterface
    {
        try {
            $response = $this->client->request($method, $uri, $options);
            $this->logger->info('REST Request', [
                'uri' => $uri,
                'method' => $method,
                'options' => $options,
                'headers' => $this->client->getConfig('headers')
            ]);
        } catch (RequestException $requestException) {
            $errorMessage = $requestException->getMessage();
            $response = $requestException->getResponse();
            $errorResponse = $response?->getBody()->getContents();
            $responseStatusCode = $response?->getStatusCode();

            $this->logger->error('REST Request error', [
                'statusCode' => $responseStatusCode,
                'url' => $uri,
                'method' => $method,
                'headers' => $this->client->getConfig('headers'),
                'options' => $options,
                'message' => $errorMessage,
                'response' => $errorResponse,
            ]);

            try {
                $responseContent = json_decode($errorResponse, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                $responseContent = $errorResponse;
            }

            return DefaultExternalResponse::new(
                false,
                $responseStatusCode,
                $responseContent
            );
        } catch (Throwable $throwable) {
            $this->logger->error('REST Client error', [
                'url' => $uri,
                'method' => $method,
                'options' => $options,
                'message' => $throwable->getMessage(),
            ]);

            return DefaultExternalResponse::new(
                false,
                $throwable->getCode(),
                $throwable->getMessage()
            );
        }

        $bodyContent = $response->getBody()->getContents();
        try {
            $responseContent = json_decode($bodyContent, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $responseContent = $bodyContent;
        }
        $this->logger->info('REST Response', [
            'uri' => $uri,
            'method' => $method,
            'code' => $response->getStatusCode(),
            'content' => substr($bodyContent, 0, 600) . '...',
        ]);

        return DefaultExternalResponse::new(
            true,
            $response->getStatusCode(),
            $responseContent
        );
    }
}
