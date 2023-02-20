<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\DTO;

class AddDocumentToSigningDTO
{
    public function __construct(
        private string $requestUrl,
        private string $documentInfo,
        private int $requestWideId,
        private string $unsignedContent
    ) {
    }

    public function getDocumentInfo(): string
    {
        return $this->documentInfo;
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    public function getRequestWideId(): int
    {
        return $this->requestWideId;
    }

    public function getUnsignedContent(): string
    {
        return $this->unsignedContent;
    }
}
