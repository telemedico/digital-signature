<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\Client;

use App\Shared\Infrastructure\Api\OAuthToken\OAuthToken;

interface ClientOAuthTokenInterface
{
    public function token(): OAuthToken;
}
