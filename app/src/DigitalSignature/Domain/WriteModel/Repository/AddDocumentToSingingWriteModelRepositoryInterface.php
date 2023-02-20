<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\WriteModel\Repository;

interface AddDocumentToSingingWriteModelRepositoryInterface
{
    public function addDocument(
        string $requestUrl,
        string $documentInfo,
        int $requestWideId,
        string $unsignedContent
    ): void;
}
