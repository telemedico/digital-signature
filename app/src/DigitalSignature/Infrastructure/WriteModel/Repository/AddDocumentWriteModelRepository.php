<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\WriteModel\Repository;

use App\DigitalSignature\Domain\WriteModel\Repository\AddDocumentWriteModelRepositoryInterface;
use App\Ports\Entity\AddDocument;
use Doctrine\ORM\EntityManagerInterface;

class AddDocumentWriteModelRepository implements AddDocumentWriteModelRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function add(AddDocument $addDocument): void
    {
        $this->entityManager->persist($addDocument);

        $this->entityManager->flush();
    }
}
