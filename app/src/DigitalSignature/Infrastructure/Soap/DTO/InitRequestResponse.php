<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Soap\DTO;

class InitRequestResponse
{
    public function __construct(
        private string $initRequestReturn
    ) {
    }

    public function getInitRequestReturn(): string
    {
        return $this->initRequestReturn;
    }
}

