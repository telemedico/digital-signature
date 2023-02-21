<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Model\Input;

use Symfony\Component\Validator\Constraints as Assert;

class DocumentToSigningRequest
{
    public function __construct(
        #[Assert\NotBlank]
        public string $content,
        #[Assert\Length(max: 250)]
        public string $documentInfo
    ) {
    }
}
