<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\WriteModel\Repository;

use App\DigitalSignature\Domain\WriteModel\ViewModel\SingingUrl;

interface SingingUrlWriteModelRepositoryInterface
{
    public function createSingingUrl(
        string $successUrl,
        string $failureUrl,
        ?string $requestInfo = null,
        ?string $authSubject = null,
        ?string $extra = null
    ): SingingUrl;
}
