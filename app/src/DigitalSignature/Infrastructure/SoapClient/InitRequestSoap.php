<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient;

use App\DigitalSignature\Infrastructure\SoapClient\DTO\InitRequest;
use App\DigitalSignature\Infrastructure\SoapClient\DTO\InitRequestResponse;
use App\DigitalSignature\Infrastructure\SoapClient\DTO\MultiSignWsException;

class InitRequestSoap extends AbstractSoap
{
    public function request(
        string $successUrl,
        string $failureUrl,
        ?string $requestInfo = null,
        ?string $authSubject = null,
        ?string $extra = null
    ): InitRequestResponse {
        return $this->getSoapClient()->__soapCall(
                'initRequest',
                [
                    new InitRequest(
                        $successUrl,
                        $failureUrl,
                        $requestInfo,
                        $authSubject,
                        $extra
                    ),
                ]
            )
        ;
    }

    protected function classMap(): array
    {
        return [
            'initRequestResponse' => InitRequestResponse::class,
            'MultiSignWsException' => MultiSignWsException::class,
        ];
    }
}
