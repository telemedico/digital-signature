<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\CQRS\Contract;

interface QueryBus
{
    public function handle(QueryMessage $query): mixed;
}
