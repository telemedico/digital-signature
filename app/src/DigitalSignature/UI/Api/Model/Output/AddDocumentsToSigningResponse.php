<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Model\Output;

class AddDocumentsToSigningResponse
{
    public function __construct(
        public string $redirectUrl,
    ) {
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }
}
