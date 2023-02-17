<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Soap\DTO;

class GetSignedDocument
{
    public function __construct(
        private string $requestUrl,
        private int $requestWideId,
        private string $authSubject,
        private string $extra
    ) {
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    public function getRequestWideId(): int
    {
        return $this->requestWideId;
    }

    public function getAuthSubject(): string
    {
        return $this->authSubject;
    }

    public function getExtra(): string
    {
        return $this->extra;
    }
}

