<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Soap;

use Psr\Log\LoggerInterface;
use SoapClient;

class LoggingSoapClient
{
    private SoapClient $soapClient;
    private LoggerInterface $logger;

    public function __construct(SoapClient $client, LoggerInterface $logger)
    {
        $this->soapClient = $client;
        $this->logger = $logger;
    }

    /**
     * @internal \SoapClient::__soapCall
     * @see SoapClient::__soapCall
     */
    public function __soapCall($name, array $args, $options = null, $inputHeaders = null, &$outputHeaders = null): mixed
    {
        try {
            $response = $this->soapClient->__soapCall($name, $args, $options, $inputHeaders, $outputHeaders);
        } catch (\SoapFault|\Throwable $e) {
            $this->logger->error($this->soapClient->__getLastRequest());
            $this->logger->error($this->soapClient->__getLastResponse());

            throw $e;
        }

        $this->logger->info($this->soapClient->__getLastRequest());
        $this->logger->info($this->soapClient->__getLastResponse());

        return $response;
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array($this->soapClient, $method), $args);
    }
}
