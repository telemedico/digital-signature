<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Transformer\Contract;

use App\DigitalSignature\Application\Command\DTO\AddDocumentsToSigningDTO;
use App\DigitalSignature\UI\Api\Model\Input\AddDocumentsToSigningRequest;

interface AddDocumentsToSigningRequestToAddDocumentsToSigningDTOTransformerInterface
{
    public function transform(AddDocumentsToSigningRequest $documentsToSigningRequest): AddDocumentsToSigningDTO;
}
