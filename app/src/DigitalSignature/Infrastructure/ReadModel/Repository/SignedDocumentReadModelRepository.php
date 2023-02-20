<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\ReadModel\Repository;

use App\DigitalSignature\Domain\ReadModel\Repository\SignedDocumentReadModelRepositoryInterface;
use App\DigitalSignature\Domain\ReadModel\ViewModel\SignedDocument;
use App\DigitalSignature\Infrastructure\SoapClient\DTO\GetSignedDocumentResponse;
use App\DigitalSignature\Infrastructure\SoapClient\GetSignedDocumentSoap;

class SignedDocumentReadModelRepository implements SignedDocumentReadModelRepositoryInterface
{
    public function __construct(
        private GetSignedDocumentSoap $getSignedDocumentSoap
    ) {
    }

    public function getSignedDocument(
        string $requestUrl,
        int $requestWideId,
        ?string $authSubject = null,
        ?string $extra = null
    ): SignedDocument {
        /** @var GetSignedDocumentResponse $response */
        $response = $this->getSignedDocumentSoap->request(
            $requestUrl,
            $requestWideId,
            $authSubject,
            $extra
        );

        return new SignedDocument($response->getGetSignedDocumentReturn());
    }
}
