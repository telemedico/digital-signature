<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Message;

use App\DigitalSignature\Application\Command\DTO\CreateSigningUrlDTO;
use App\DigitalSignature\Domain\WriteModel\ViewModel\SingingUrl;
use App\Shared\Infrastructure\CQRS\Contract\CommandMessage;

class CreateSigningUrlCommandMessage implements CommandMessage
{
    private SingingUrl $singingUrl;

    public function __construct
    (
        private CreateSigningUrlDTO $createSingingUrlDTO
    ) {
    }

    public function getCreateSingingUrlDTO(): CreateSigningUrlDTO
    {
        return $this->createSingingUrlDTO;
    }

    public function getSingingUrl(): SingingUrl
    {
        return $this->singingUrl;
    }

    public function setSingingUrl(SingingUrl $singingUrl): CreateSigningUrlCommandMessage
    {
        $this->singingUrl = $singingUrl;

        return $this;
    }
}
