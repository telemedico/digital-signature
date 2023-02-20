<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Query\DTO;

class GetSignedDocumentDTO
{
    public function __construct(
        private string $requestUrl,
        private int $requestWideId,
        private ?string $authSubject = null,
        private ?string $extra = null
    ) {
    }

    public function getRequestWideId(): int
    {
        return $this->requestWideId;
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    public function getExtra(): ?string
    {
        return $this->extra;
    }

    public function getAuthSubject(): ?string
    {
        return $this->authSubject;
    }
}
