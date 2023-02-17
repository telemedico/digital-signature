<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Soap\DTO;

class GetSignedDocumentResponse
{
    public function __construct(
        private string $getSignedDocumentReturn
    ) {
    }

    public function getGetSignedDocumentReturn(): string
    {
        return $this->getSignedDocumentReturn;
    }
}

