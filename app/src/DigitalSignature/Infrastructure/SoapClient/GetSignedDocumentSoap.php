<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient;

use App\DigitalSignature\Infrastructure\SoapClient\DTO\GetSignedDocument;
use App\DigitalSignature\Infrastructure\SoapClient\DTO\GetSignedDocumentResponse;
use App\DigitalSignature\Infrastructure\SoapClient\DTO\MultiSignWsException;

class GetSignedDocumentSoap extends AbstractSoap
{
    public function request(
        string $requestUrl,
        int $requestWideId,
        ?string $authSubject = null,
        ?string $extra = null
    ): GetSignedDocumentResponse {
        return $this->getSoapClient()->__soapCall(
                'GetSignedDocument',
                [
                    new GetSignedDocument(
                        $requestUrl,
                        $requestWideId,
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
            'getSignedDocumentResponse' => GetSignedDocumentResponse::class,
            'MultiSignWsException' => MultiSignWsException::class,
        ];
    }
}
