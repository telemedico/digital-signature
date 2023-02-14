<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\CQRS;

use App\Shared\Infrastructure\CQRS\Contract\CommandMessage;
use App\Shared\Infrastructure\CQRS\Contract\CommandBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(CommandMessage $command): void
    {
        try {
            $this->commandBus->dispatch($command);
        } catch (HandlerFailedException $exception) {
            //throw real exception
            throw (new \ArrayObject($exception->getNestedExceptions()))->getIterator()->current();
        }
    }
}
