<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\ReadModel\Repository;

use App\DigitalSignature\Domain\ReadModel\ViewModel\SignedDocument;

interface SignedDocumentReadModelRepositoryInterface
{
    public function getSignedDocument(
        string $requestUrl,
        int $requestWideId,
        ?string $authSubject = null,
        ?string $extra = null
    ): SignedDocument;
}
