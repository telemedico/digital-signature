<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient\Config;

class SoapConfig implements SoapConfigInterface
{
    private array $classMap = [];

    public function __construct(
        private string $url,
        private string $cert,
        private string $certPassword
    ) {
    }

    public function url(): string
    {
        return $this->url;
    }

    public function cert(): string
    {
        return $this->cert;
    }

    public function classMap(): array
    {
        return $this->classMap;
    }

    public function setClassMap(array $classMap): void
    {
        $this->classMap = $classMap;
    }

    public function certPassword(): string
    {
        return $this->certPassword;
    }
}
