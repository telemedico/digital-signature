<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Transformer;

use App\DigitalSignature\Application\Command\DTO\AddDocumentsToSigningDTO;
use App\DigitalSignature\Application\Command\DTO\CreateSigningUrlDTO;
use App\DigitalSignature\Infrastructure\Transformer\Contract\AddDocumentsToSigningDTOToCreateSigningUrlDTOTransformerInterface;

class AddDocumentsToSigningDTOToCreateSigningUrlDTOTransformer implements
    AddDocumentsToSigningDTOToCreateSigningUrlDTOTransformerInterface
{
    public function transform(AddDocumentsToSigningDTO $addDocumentsToSigningDTO): CreateSigningUrlDTO
    {
        return new CreateSigningUrlDTO(
            $addDocumentsToSigningDTO->getSuccessUrl(),
            $addDocumentsToSigningDTO->getFailureUrl(),
            $addDocumentsToSigningDTO->getRequestInfo()
        );
    }
}
