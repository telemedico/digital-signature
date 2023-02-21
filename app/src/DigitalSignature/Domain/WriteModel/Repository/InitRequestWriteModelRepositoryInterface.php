<?php

declare(strict_types=1);

namespace App\DigitalSignature\Domain\WriteModel\Repository;

use App\Ports\Entity\InitRequest;

interface InitRequestWriteModelRepositoryInterface
{
    public function add(InitRequest $initRequest): void;
}
