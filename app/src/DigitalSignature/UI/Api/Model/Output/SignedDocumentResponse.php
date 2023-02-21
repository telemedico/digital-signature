<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Model\Output;

class SignedDocumentResponse
{
    public function __construct(
        public string $content,
    ) {
    }
}
