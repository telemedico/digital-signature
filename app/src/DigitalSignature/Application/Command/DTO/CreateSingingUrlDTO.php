<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\DTO;

class CreateSingingUrlDTO
{
    public function __construct(
        private string $successUrl,
        private string $failureUrl,
        private ?string $requestInfo = null,
        private ?string $authSubject = null,
        private ?string $extra = null
    ) {
    }

    public function getAuthSubject(): ?string
    {
        return $this->authSubject;
    }

    public function getExtra(): ?string
    {
        return $this->extra;
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    public function getFailureUrl(): string
    {
        return $this->failureUrl;
    }

    public function getRequestInfo(): ?string
    {
        return $this->requestInfo;
    }
}
