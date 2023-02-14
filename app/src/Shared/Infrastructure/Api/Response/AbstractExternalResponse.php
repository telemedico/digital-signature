<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\Response;

use JetBrains\PhpStorm\ArrayShape;

abstract class AbstractExternalResponse implements ExternalResponseInterface
{
    private int $statusCode;
    private mixed $response;
    private bool $status;

    public function __construct(
        bool $status,
        int $statusCode,
        mixed $response
    ) {
        $this->status = $status;
        $this->statusCode = $statusCode;
        $this->response = $response;
    }

    public function isSuccessful(): bool
    {
        return $this->status === true;
    }

    public function status(): bool
    {
        return $this->status;
    }

    public function statusCode(): int
    {
        return $this->statusCode;
    }

    public function response(): mixed
    {
        return $this->response;
    }

    public function valueFromResponse(int|string $key): mixed
    {
        if (!is_array($this->response)) {
            return null;
        }

        return $this->response[$key] ?? null;
    }

    #[ArrayShape(['status' => "bool", 'statusCode' => "int", 'response' => "mixed"])]
    public function jsonSerialize(): array
    {
        return [
            'status' => $this->status,
            'statusCode' => $this->statusCode,
            'response' => $this->response
        ];
    }
}
