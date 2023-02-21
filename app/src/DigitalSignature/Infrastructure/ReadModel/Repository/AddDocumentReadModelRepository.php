<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\ReadModel\Repository;

use App\DigitalSignature\Domain\ReadModel\Repository\AddDocumentReadModelRepositoryInterface;
use App\Ports\Entity\AddDocument;
use Doctrine\ORM\EntityManagerInterface;

class AddDocumentReadModelRepository implements AddDocumentReadModelRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findByRequestUrl(string $requestUrl): array
    {
        return $this->entityManager->getRepository(AddDocument::class)->findBy(['requestUrl' => $requestUrl]);
    }
}
