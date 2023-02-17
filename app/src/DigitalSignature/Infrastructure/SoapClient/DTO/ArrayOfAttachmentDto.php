<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\SoapClient\DTO;

class ArrayOfAttachmentDto
{
    public function __construct(
        private AttachmentDto $AttachmentDto
    ) {
    }

    public function getAttachmentDto(): AttachmentDto
    {
        return $this->AttachmentDto;
    }
}
