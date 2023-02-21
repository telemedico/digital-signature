<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Query\Handler;

use App\DigitalSignature\Application\Query\DTO\GetSignedDocumentDTO;
use App\DigitalSignature\Application\Query\Message\GetSignedDocumentQueryMessage;
use App\DigitalSignature\Application\Query\Message\GetSignedDocumentsQueryMessage;
use App\DigitalSignature\Domain\ReadModel\Repository\AddDocumentReadModelRepositoryInterface;
use App\Ports\Entity\AddDocument;
use App\Shared\Infrastructure\CQRS\Contract\QueryBus;
use App\Shared\Infrastructure\CQRS\Contract\QueryHandler;

class GetSignedDocumentsQueryHandler implements QueryHandler
{
    public function __construct(
        private QueryBus $queryBus,
        private AddDocumentReadModelRepositoryInterface $addDocumentReadModelRepository
    ) {
    }

    public function __invoke(GetSignedDocumentsQueryMessage $message): array
    {
        $documents = $this->addDocumentReadModelRepository->findByRequestUrl(
            $message->getGetSignedDocumentsDTO()->getRequestUrl()
        );

        $signedDocuments = [];

        /** @var AddDocument $document */
        foreach ($documents as $document) {
            $getSignedDocumentDTO = new GetSignedDocumentDTO(
                $document->getRequestUrl(),
                $document->getRequestWideId()
            );

            $signedDocuments[] = $this->queryBus->handle(
                new GetSignedDocumentQueryMessage($getSignedDocumentDTO)
            );
        }

        return $signedDocuments;
    }
}
