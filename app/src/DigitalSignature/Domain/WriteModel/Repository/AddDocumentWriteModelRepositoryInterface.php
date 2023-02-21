<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\WriteModel\Repository;

use App\Ports\Entity\AddDocument;

interface AddDocumentWriteModelRepositoryInterface
{
    public function add(AddDocument $addDocument): void;
}
