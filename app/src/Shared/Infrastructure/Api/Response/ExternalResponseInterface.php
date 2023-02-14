<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\Response;

use JsonSerializable;

interface ExternalResponseInterface extends JsonSerializable
{
    public function isSuccessful(): bool;
    public function status(): bool;
    public function statusCode(): int;
    public function response(): mixed;
    public function valueFromResponse(int|string $key): mixed;
}
