<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Model;

use App\DigitalSignature\UI\Api\Controller\TestController;
use Prugala\RequestDto\Dto\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

class TestModel implements RequestDtoInterface
{
    #[Assert\NotBlank]
    public string $id;

    #[Assert\NotBlank]
    public string $name = '';

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
