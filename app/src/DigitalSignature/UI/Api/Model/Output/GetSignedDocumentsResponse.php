<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Model\Output;

class GetSignedDocumentsResponse
{
    public function __construct(
        public array $documents,
    ) {
    }
}
