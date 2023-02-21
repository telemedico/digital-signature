<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\DTO;

class AddDocumentsToSigningDTO
{
    public function __construct(
        private string $successUrl,
        private string $failureUrl,
        private string $requestInfo,
        private array $documents,
    ) {
    }

    public function getRequestInfo(): string
    {
        return $this->requestInfo;
    }

    public function getFailureUrl(): string
    {
        return $this->failureUrl;
    }

    public function getSuccessUrl(): string
    {
        return $this->successUrl;
    }

    public function getDocuments(): array
    {
        return $this->documents;
    }
}
