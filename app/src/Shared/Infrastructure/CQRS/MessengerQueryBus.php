<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\CQRS;

use App\Shared\Infrastructure\CQRS\Contract\QueryMessage;
use App\Shared\Infrastructure\CQRS\Contract\QueryBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function handle(QueryMessage $query): mixed
    {
        try {
            return $this->handleQuery($query);
        } catch (HandlerFailedException $exception) {
            //throw real exception
            throw (new \ArrayObject($exception->getNestedExceptions()))->getIterator()->current();
        }
    }
}
