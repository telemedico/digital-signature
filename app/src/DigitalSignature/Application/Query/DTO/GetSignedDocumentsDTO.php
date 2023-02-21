<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Query\DTO;

class GetSignedDocumentsDTO
{
    public function __construct(
        private string $requestUrl,
    ) {
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }
}
