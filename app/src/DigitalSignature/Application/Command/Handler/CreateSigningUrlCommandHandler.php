<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Handler;

use App\DigitalSignature\Application\Command\DTO\CreateSigningUrlDTO;
use App\DigitalSignature\Application\Command\Message\CreateSigningUrlCommandMessage;
use App\DigitalSignature\Domain\WriteModel\Repository\SingingUrlWriteModelRepositoryInterface;
use App\DigitalSignature\Domain\WriteModel\ViewModel\SingingUrl;
use App\Shared\Infrastructure\CQRS\Contract\CommandHandler;

class CreateSigningUrlCommandHandler implements CommandHandler
{
    public function __construct(private SingingUrlWriteModelRepositoryInterface $singingUrlRepository)
    {
    }

    public function __invoke(CreateSigningUrlCommandMessage $message): void
    {
        /** @var CreateSigningUrlDTO $dto */
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
