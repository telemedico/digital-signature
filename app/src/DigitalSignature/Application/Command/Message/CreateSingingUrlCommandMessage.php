<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Message;

use App\DigitalSignature\Application\Command\DTO\CreateSingingUrlDTO;
use App\DigitalSignature\Domain\WriteModel\ViewModel\SingingUrl;
use App\Shared\Infrastructure\CQRS\Contract\CommandMessage;

class CreateSingingUrlCommandMessage implements CommandMessage
{
    private SingingUrl $singingUrl;

    public function __construct
    (
        private CreateSingingUrlDTO $createSingingUrlDTO
    ) {
    }

    public function getCreateSingingUrlDTO(): CreateSingingUrlDTO
    {
        return $this->createSingingUrlDTO;
    }

    public function getSingingUrl(): SingingUrl
    {
        return $this->singingUrl;
    }

    public function setSingingUrl(SingingUrl $singingUrl): CreateSingingUrlCommandMessage
    {
        $this->singingUrl = $singingUrl;

        return $this;
    }
}
