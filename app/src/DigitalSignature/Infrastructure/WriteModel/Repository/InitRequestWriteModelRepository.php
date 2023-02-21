<?php

declare(strict_types=1);

namespace App\DigitalSignature\Infrastructure\WriteModel\Repository;

use App\DigitalSignature\Domain\WriteModel\Repository\InitRequestWriteModelRepositoryInterface;
use App\Ports\Entity\InitRequest;
use Doctrine\ORM\EntityManagerInterface;

class InitRequestWriteModelRepository implements InitRequestWriteModelRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function add(InitRequest $initRequest): void
    {
        $this->entityManager->persist($initRequest);

        $this->entityManager->flush();
    }
}
