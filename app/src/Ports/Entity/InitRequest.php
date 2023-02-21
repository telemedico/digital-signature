<?php

declare(strict_types=1);

namespace App\Ports\Entity;

use \DateTimeImmutable;

class InitRequest
{
    private DateTimeImmutable $createdAt;

    public function __construct(
        private string $redirectUrl,
        private ?string $requestInfo = null,
        private ?string $authSubject = null,
        private ?string $extra = null
    ) {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getRequestInfo(): ?string
    {
        return $this->requestInfo;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    public function getAuthSubject(): ?string
    {
        return $this->authSubject;
    }

    public function getExtra(): ?string
    {
        return $this->extra;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
