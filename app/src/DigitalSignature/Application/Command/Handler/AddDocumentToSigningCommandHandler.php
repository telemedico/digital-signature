<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Handler;

use App\DigitalSignature\Application\Command\DTO\AddDocumentToSigningDTO;
use App\DigitalSignature\Application\Command\Message\AddDocumentToSigningCommandMessage;
use App\DigitalSignature\Domain\WriteModel\Repository\AddDocumentToSingingWriteModelRepositoryInterface;
use App\Shared\Infrastructure\CQRS\Contract\CommandHandler;

class AddDocumentToSigningCommandHandler implements CommandHandler
{
    public function __construct(
        private AddDocumentToSingingWriteModelRepositoryInterface $repository
    ) {
    }

    public function __invoke(AddDocumentToSigningCommandMessage $message): void
    {
        /** @var AddDocumentToSigningDTO $dto */
        $dto = $message->getAddDocumentToSigningDTO();

        $this->repository->addDocument(
            $dto->getRequestUrl(),
            $dto->getDocumentInfo(),
            $dto->getRequestWideId(),
            $dto->getUnsignedContent()
        );
    }
}
