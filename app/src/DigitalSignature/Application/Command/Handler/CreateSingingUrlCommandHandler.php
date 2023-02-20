<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Handler;

use App\DigitalSignature\Application\Command\DTO\CreateSingingUrlDTO;
use App\DigitalSignature\Application\Command\Message\CreateSingingUrlCommandMessage;
use App\DigitalSignature\Domain\WriteModel\Repository\SingingUrlWriteModelRepositoryInterface;
use App\DigitalSignature\Domain\WriteModel\ViewModel\SingingUrl;
use App\Shared\Infrastructure\CQRS\Contract\CommandHandler;

class CreateSingingUrlCommandHandler implements CommandHandler
{
    public function __construct(private SingingUrlWriteModelRepositoryInterface $singingUrlRepository)
    {
    }

    public function __invoke(CreateSingingUrlCommandMessage $message): void
    {
        /** @var CreateSingingUrlDTO $dto */
        $dto = $message->getCreateSingingUrlDTO();

        /** @var SingingUrl $singingUrl */
        $singingUrl = $this->singingUrlRepository->createSingingUrl(
            $dto->getSuccessUrl(),
            $dto->getFailureUrl(),
            $dto->getRequestInfo(),
            $dto->getAuthSubject(),
            $dto->getExtra()
        );

        $message->setSingingUrl($singingUrl);
    }
}
