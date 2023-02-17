<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient;

use App\DigitalSignature\Infrastructure\SoapClient\Config\SoapConfig;
use App\DigitalSignature\Infrastructure\SoapClient\Config\SoapConfigInterface;
use App\Shared\Infrastructure\Soap\LoggingSoapClient;
use Ghindows\SoapClient\SignedSoapClient;
use Psr\Log\LoggerInterface;

class SoapClient
{
    private ?LoggingSoapClient $soapClient = null;

    public function __construct(
        private SoapConfigInterface $soapConfig,
        private LoggerInterface $logger
    ) {
    }

    public function init(): void
    {
        if ($this->soapClient instanceof LoggingSoapClient) {
            return;
        }
        try {
            $this->soapClient = new LoggingSoapClient(
                new SignedSoapClient(
                    $this->soapConfig->url(),
                    [
                        'location' => $this->soapConfig->url(),
                        'soap_version' => SOAP_1_1,
                        'trace' => 1,
                        'exceptions' => 1,
                        'cache_wsdl' => WSDL_CACHE_NONE,
                        'classmap' => $this->soapConfig->classMap(),
                        'ssl' => [
                            'cert' => $this->soapConfig->cert(),
                            'certpasswd' => $this->soapConfig->certPassword()
                        ]
                    ]
                ),
                $this->logger
            );
        } catch (\SoapFault $e) {
            throw $e;
        }
    }

    public function client(): LoggingSoapClient
    {
        $this->init();

        return $this->soapClient;
    }
}
