<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient;

use App\DigitalSignature\Infrastructure\SoapClient\DTO\AddDocumentToRequest;
use App\DigitalSignature\Infrastructure\SoapClient\DTO\AddDocumentToRequestResponse;
use App\DigitalSignature\Infrastructure\SoapClient\DTO\MultiSignWsException;

class AddDocumentToRequestSoap extends AbstractSoap
{
    public function request(
        string $requestUrl,
        string $documentInfo,
        int $requestWideId,
        string $unsignedContent
    ): AddDocumentToRequestResponse {
        return $this->getSoapClient()->__soapCall(
                'addDocumentToRequest',
                [
                    new AddDocumentToRequest(
                        $requestUrl,
                        $documentInfo,
                        $requestWideId,
                        $unsignedContent
                    ),
                ]
            )
        ;
    }

    protected function classMap(): array
    {
        return [
            'addDocumentToRequestResponse' => AddDocumentToRequestResponse::class,
            'MultiSignWsException' => MultiSignWsException::class,
        ];
    }
}
