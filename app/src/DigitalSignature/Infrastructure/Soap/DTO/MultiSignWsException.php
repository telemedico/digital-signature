<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\Soap\DTO;

class MultiSignWsException
{
    public function __construct(
        private string $message
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}

