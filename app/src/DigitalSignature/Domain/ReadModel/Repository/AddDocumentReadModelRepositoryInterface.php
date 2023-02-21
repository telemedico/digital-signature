<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\ReadModel\Repository;

interface AddDocumentReadModelRepositoryInterface
{
    public function findByRequestUrl(string $requestUrl): array;
}
