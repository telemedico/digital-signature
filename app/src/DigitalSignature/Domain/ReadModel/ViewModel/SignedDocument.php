<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\ReadModel\ViewModel;

class SignedDocument
{
    public function __construct(
        private string $content
    ) {
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
