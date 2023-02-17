<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient\Config;

interface SoapConfigInterface
{
    public function url(): string;
    public function cert():string;
    public function certPassword():string;
    public function classMap(): array;
    public function setClassMap(array $classMap): void;
}
