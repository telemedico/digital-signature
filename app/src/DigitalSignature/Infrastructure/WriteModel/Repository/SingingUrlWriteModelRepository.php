<?php

declare(strict_types=1);

namespace App\DigitalSignature\Intrastructure\WriteModel\Repository;

use App\DigitalSignature\Domain\WriteModel\Repository\SingingUrlWriteModelRepositoryInterface;
use App\DigitalSignature\Domain\WriteModel\ViewModel\SingingUrl;
use App\DigitalSignature\Infrastructure\SoapClient\InitRequestSoap;

class SingingUrlWriteModelRepository implements SingingUrlWriteModelRepositoryInterface
{
    public function __construct(private InitRequestSoap $initRequestSoap)
    {
    }

    public function createSingingUrl(
        string $successUrl,
        string $failureUrl,
        ?string $requestInfo = null,
        ?string $authSubject = null,
        ?string $extra = null
    ): SingingUrl {
        $response = $this->initRequestSoap->request(
            $successUrl,
            $failureUrl,
            $requestInfo,
            $authSubject,
            $extra
        );

        return new SingingUrl($response->getInitRequestReturn());
    }
}
