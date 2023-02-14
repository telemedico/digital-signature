<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Api\OAuthToken;

use \DateTimeImmutable;

class OAuthToken
{
    private string $accessToken;
    private string $tokenType;
    private string|null $refreshToken;
    private DateTimeImmutable $expiresAt;
    private string|null $scope;

    public function __construct(
        string $tokenType,
        string $accessToken,
        ?string $refreshToken,
        DateTimeImmutable $expiresAt,
        ?string $scope
    ) {
        $this->tokenType = $tokenType;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->expiresAt = $expiresAt;
        $this->scope = $scope;
    }

    public static function new(
        string $tokenType,
        string $accessToken,
        ?string $refreshToken,
        DateTimeImmutable $expiresAt,
        ?string $scope
    ): self {
        return new self($tokenType, $accessToken, $refreshToken, $expiresAt, $scope);
    }

    public function accessToken(): string
    {
        return $this->accessToken;
    }

    public function tokenType(): string
    {
        return $this->tokenType;
    }

    public function refreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function expiresAt(): DateTimeImmutable
    {
        return $this->expiresAt;
    }

    public function isExpired(): bool
    {
        return $this->expiresAt() <= new DateTimeImmutable('now');
    }

    public function scope(): ?string
    {
        return $this->scope;
    }
}
