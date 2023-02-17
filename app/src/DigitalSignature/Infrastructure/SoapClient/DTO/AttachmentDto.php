<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient\DTO;

class AttachmentDto
{
    public function __construct(
        private string $content,
        private ?string $mimeType = null,
        private ?string $uri = null
    ) {
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }
}
