<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Transformer;

use App\DigitalSignature\Application\Command\DTO\AddDocumentsToSigningDTO;
use App\DigitalSignature\Application\Command\DTO\DocumentToSigningDTO;
use App\DigitalSignature\Infrastructure\Transformer\Contract\AddDocumentsToSigningRequestToAddDocumentsToSigningDTOTransformerInterface;
use App\DigitalSignature\UI\Api\Model\Input\AddDocumentsToSigningRequest;
use App\DigitalSignature\UI\Api\Model\Input\DocumentToSigningRequest;

class AddDocumentsToSigningRequestToAddDocumentsToSigningDTOTransformer implements
    AddDocumentsToSigningRequestToAddDocumentsToSigningDTOTransformerInterface
{
    public function transform(AddDocumentsToSigningRequest $documentsToSigningRequest): AddDocumentsToSigningDTO
    {
        $documents = array_map(static function (DocumentToSigningRequest $document)
        {
            return new DocumentToSigningDTO(
                $document->content,
                $document->documentInfo
            );
        }, $documentsToSigningRequest->documents);

        return new AddDocumentsToSigningDTO(
            $documentsToSigningRequest->successUrl,
            $documentsToSigningRequest->failureUrl,
            $documentsToSigningRequest->requestInfo,
            $documents
        );
    }
}
