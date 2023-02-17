<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient;

use App\DigitalSignature\Infrastructure\SoapClient\Config\SoapConfigInterface;
use App\Shared\Infrastructure\Soap\LoggingSoapClient;
use Psr\Log\LoggerInterface;

abstract class AbstractSoap
{
    public function __construct(
        protected SoapConfigInterface $soapConfig,
        protected LoggerInterface $integrationLogger
    ) {
    }

    public function getSoapClient(): LoggingSoapClient
    {
        $soapQBS = new SoapClient($this->soapConfig, $this->integrationLogger);

        return $soapQBS->client();
    }

    abstract protected function classMap(): array;
}
