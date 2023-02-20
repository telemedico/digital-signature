<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Handler;

use App\DigitalSignature\Application\Command\Message\AddDocumentToSigningCommandMessage;
use App\Shared\Infrastructure\CQRS\Contract\CommandHandler;

class AddDocumentToSigningCommandHandler implements CommandHandler
{
    public function __invoke(AddDocumentToSigningCommandMessage $message): void
    {

    }
}
