<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Transformer\Contract;

use App\DigitalSignature\Application\Command\DTO\AddDocumentsToSigningDTO;
use App\DigitalSignature\Application\Command\DTO\CreateSigningUrlDTO;

interface AddDocumentsToSigningDTOToCreateSigningUrlDTOTransformerInterface
{
    public function transform(AddDocumentsToSigningDTO $addDocumentsToSigningDTO): CreateSigningUrlDTO;
}
