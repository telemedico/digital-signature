<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Message;

use App\DigitalSignature\Application\Command\DTO\AddDocumentToSigningDTO;
use App\Shared\Infrastructure\CQRS\Contract\CommandMessage;

class AddDocumentToSigningCommandMessage implements CommandMessage
{
    private array $response;

    public function __construct
    (
        private AddDocumentToSigningDTO $addDocumentToSigningDTO
    ) {
    }

    public function getAddDocumentToSigningDTO(): AddDocumentToSigningDTO
    {
        return $this->addDocumentToSigningDTO;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function setResponse(array $response): AddDocumentToSigningCommandMessage
    {
        $this->response = $response;

        return $this;
    }
}
