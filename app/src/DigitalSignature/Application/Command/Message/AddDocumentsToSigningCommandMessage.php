<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Message;

use App\DigitalSignature\Application\Command\DTO\AddDocumentsToSigningDTO;
use App\Shared\Infrastructure\CQRS\Contract\CommandMessage;

class AddDocumentsToSigningCommandMessage implements CommandMessage
{
    private string $redirectUrl;

    public function __construct
    (
        private AddDocumentsToSigningDTO $addDocumentsToSigningDTO
    ) {
    }

    public function getAddDocumentsToSigningDTO(): AddDocumentsToSigningDTO
    {
        return $this->addDocumentsToSigningDTO;
    }

    public function setRedirectUrl(string $redirectUrl): AddDocumentsToSigningCommandMessage
    {
        $this->redirectUrl = $redirectUrl;

        return $this;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }
}
