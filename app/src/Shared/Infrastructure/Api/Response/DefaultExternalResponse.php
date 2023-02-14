<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\Response;

use JetBrains\PhpStorm\Pure;

class DefaultExternalResponse extends AbstractExternalResponse
{
    #[Pure]
    public static function new(
        bool $status,
        int $statusCode,
        mixed $response
    ): self {
        return new self($status, $statusCode, $response);
    }
}
