<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\DTO;

class DocumentToSigningDTO
{
    public function __construct(
        private string $content,
        private string $documentInfo
    ) {
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getDocumentInfo(): string
    {
        return $this->documentInfo;
    }
}
