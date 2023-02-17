<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Soap\DTO;

class AddDocumentToRequest
{
    public function __construct(
        private string $requestUrl,
        private string $documentInfo,
        private int $requestWideId,
        private string $unsignedContent,
        private ArrayOfAttachmentDto $attachments,
        private string $authSubject,
        private string $extra
    ) {
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    public function getDocumentInfo(): string
    {
        return $this->documentInfo;
    }

    public function getRequestWideId(): int
    {
        return $this->requestWideId;
    }

    public function getUnsignedContent(): string
    {
        return $this->unsignedContent;
    }

    public function getAttachments(): ArrayOfAttachmentDto
    {
        return $this->attachments;
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

