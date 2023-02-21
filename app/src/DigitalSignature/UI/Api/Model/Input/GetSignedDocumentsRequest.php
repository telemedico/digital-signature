<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Model\Input;

use Symfony\Component\Validator\Constraints as Assert;

class GetSignedDocumentsRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Url]
        public string $redirectUrl
    ) {
    }
}
