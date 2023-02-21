<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Transformer\Contract;

use App\DigitalSignature\UI\Api\Model\Output\GetSignedDocumentsResponse;

interface ArrayOfSignedDocumentsToGetSignedDocumentsResponseTransformerInterface
{
    public function transform(array $signedDocuments): GetSignedDocumentsResponse;
}
