<?php

declare(strict_types=1);

namespace App\DigitalSignature\Intrastructure\WriteModel\Repository;

use App\DigitalSignature\Domain\WriteModel\Repository\AddDocumentToSingingWriteModelRepositoryInterface;
use App\DigitalSignature\Infrastructure\SoapClient\AddDocumentToRequestSoap;

class AddDocumentToSingingWriteModelRepository implements AddDocumentToSingingWriteModelRepositoryInterface
{
    public function __construct(
        private AddDocumentToRequestSoap $addDocumentToRequestSoap
    ) {
    }

    public function addDocument(
        string $requestUrl,
        string $documentInfo,
        int $requestWideId,
        string $unsignedContent
    ): void {
        $this->addDocumentToRequestSoap->request($requestUrl, $documentInfo, $requestWideId, $unsignedContent);
    }
}
