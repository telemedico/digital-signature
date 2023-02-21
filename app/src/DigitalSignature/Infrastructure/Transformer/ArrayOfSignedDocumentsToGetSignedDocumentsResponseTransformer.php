<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Transformer;

use App\DigitalSignature\Domain\ReadModel\ViewModel\SignedDocument;
use App\DigitalSignature\Infrastructure\Transformer\Contract\ArrayOfSignedDocumentsToGetSignedDocumentsResponseTransformerInterface;
use App\DigitalSignature\UI\Api\Model\Output\GetSignedDocumentsResponse;
use App\DigitalSignature\UI\Api\Model\Output\SignedDocumentResponse;

class ArrayOfSignedDocumentsToGetSignedDocumentsResponseTransformer implements
    ArrayOfSignedDocumentsToGetSignedDocumentsResponseTransformerInterface
{
    public function transform(array $signedDocuments): GetSignedDocumentsResponse
    {
        $documents = array_map(static function (SignedDocument $document)
        {
            return new SignedDocumentResponse($document->getContent());
        }, $signedDocuments);

        return new GetSignedDocumentsResponse($documents);
    }
}
