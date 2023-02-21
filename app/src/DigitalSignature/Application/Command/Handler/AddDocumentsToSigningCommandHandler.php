<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Command\Handler;

use App\DigitalSignature\Application\Command\DTO\AddDocumentToSigningDTO;
use App\DigitalSignature\Application\Command\DTO\DocumentToSigningDTO;
use App\DigitalSignature\Application\Command\Message\AddDocumentsToSigningCommandMessage;
use App\DigitalSignature\Application\Command\Message\AddDocumentToSigningCommandMessage;
use App\DigitalSignature\Application\Command\Message\CreateSigningUrlCommandMessage;
use App\DigitalSignature\Domain\WriteModel\Repository\AddDocumentWriteModelRepositoryInterface;
use App\DigitalSignature\Infrastructure\Transformer\Contract\AddDocumentsToSigningDTOToCreateSigningUrlDTOTransformerInterface;
use App\DigitalSignature\Infrastructure\WriteModel\Repository\InitRequestWriteModelRepository;
use App\Ports\Entity\AddDocument;
use App\Ports\Entity\InitRequest;
use App\Shared\Infrastructure\CQRS\Contract\CommandBus;
use App\Shared\Infrastructure\CQRS\Contract\CommandHandler;

class AddDocumentsToSigningCommandHandler implements CommandHandler
{
    public function __construct(
        private CommandBus $commandBus,
        private AddDocumentsToSigningDTOToCreateSigningUrlDTOTransformerInterface $addDocumentsToSigningDTOToCreateSigningUrlDTOTransformer,
        private InitRequestWriteModelRepository $initRequestWriteModelRepository,
        private AddDocumentWriteModelRepositoryInterface $addDocumentWriteModelRepository
    ) {
    }

    public function __invoke(AddDocumentsToSigningCommandMessage $message): void
    {
        $createSigningUrlCommandMessage = new CreateSigningUrlCommandMessage(
            $this->addDocumentsToSigningDTOToCreateSigningUrlDTOTransformer->transform(
                $message->getAddDocumentsToSigningDTO()
            )
        );

        $this->commandBus->dispatch($createSigningUrlCommandMessage);

        $this->initRequestWriteModelRepository->add(
            new InitRequest(
                $createSigningUrlCommandMessage->getSingingUrl()->getUrl(),
                $createSigningUrlCommandMessage->getCreateSingingUrlDTO()->getRequestInfo()
            )
        );

        $i = 1;
        /** @var DocumentToSigningDTO $document */
        foreach (
            $message->getAddDocumentsToSigningDTO()->getDocuments() as $document
        ) {
            $addDocumentToSigningDTO = new AddDocumentToSigningDTO(
                $createSigningUrlCommandMessage->getSingingUrl()->getUrl(),
                $document->getDocumentInfo(),
                $i,
                $document->getContent()
            );

            $this->commandBus->dispatch(new AddDocumentToSigningCommandMessage($addDocumentToSigningDTO));

            $this->addDocumentWriteModelRepository->add(
                new AddDocument(
                    $createSigningUrlCommandMessage->getSingingUrl()->getUrl(),
                    $document->getDocumentInfo(),
                    $i
                )
            );

            $i++;
        }

        $message->setRedirectUrl($createSigningUrlCommandMessage->getSingingUrl()->getUrl());
    }
}
