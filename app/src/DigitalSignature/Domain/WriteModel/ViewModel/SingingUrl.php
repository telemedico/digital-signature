<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\WriteModel\ViewModel;

class SingingUrl
{
    public function __construct(
        private string $url
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
