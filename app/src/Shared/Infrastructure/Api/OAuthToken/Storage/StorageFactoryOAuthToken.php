<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\OAuthToken\Storage;

use App\Shared\Infrastructure\Api\Client\ClientOAuthTokenInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class StorageFactoryOAuthToken
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function create(ClientOAuthTokenInterface $client): StorageOAuthToken
    {
        return new StorageOAuthToken($client, $this->kernel);
    }
}
