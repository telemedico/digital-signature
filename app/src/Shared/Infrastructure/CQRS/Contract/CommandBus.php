<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\CQRS\Contract;

interface CommandBus
{
    public function dispatch(CommandMessage $command): void;
}
