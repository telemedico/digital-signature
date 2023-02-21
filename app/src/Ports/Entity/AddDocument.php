<?php

declare(strict_types=1);

namespace App\Ports\Entity;

use \DateTimeImmutable;

class AddDocument
{
    private DateTimeImmutable $createdAt;
    private int $id;

    public function __construct(
        private string $requestUrl,
        private string $documentInfo,
        private int $requestWideId,
    ) {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getDocumentInfo(): string
    {
        return $this->documentInfo;
    }

    public function getRequestUrl(): string
    {
        return $this->requestUrl;
    }

    public function getRequestWideId(): int
    {
        return $this->requestWideId;
    }

    public function setId(int $id): AddDocument
    {
        $this->id = $id;

        return $this;
    }
}
