<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Soap\DTO;

class InitRequest
{
    public function __construct(
        private string $successUrl,
        private string $failureUrl,
        private string $requestInfo,
        private string $authSubject,
        private string $extra
    ) {
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    public function getFailureUrl(): string
    {
        return $this->failureUrl;
    }

    public function getRequestInfo(): string
    {
        return $this->requestInfo;
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

