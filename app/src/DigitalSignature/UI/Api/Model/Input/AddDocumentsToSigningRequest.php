<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Model\Input;

use Symfony\Component\Validator\Constraints as Assert;

class AddDocumentsToSigningRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Url]
        public string $successUrl,
        #[Assert\NotBlank]
        #[Assert\Url]
        public string $failureUrl,
        #[Assert\Length(max: 1024)]
        public string $requestInfo,
        /** @var DocumentToSigningRequest[]  */
        #[Assert\Count(min: 1)]
        #[Assert\Valid]
        public array $documents,
    ) {
    }
}
