<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Query\Handler;

use App\DigitalSignature\Application\Query\DTO\GetSignedDocumentDTO;
use App\DigitalSignature\Application\Query\Message\GetSignedDocumentQueryMessage;
use App\DigitalSignature\Domain\ReadModel\Repository\SignedDocumentReadModelRepositoryInterface;
use App\DigitalSignature\Domain\ReadModel\ViewModel\SignedDocument;
use App\Shared\Infrastructure\CQRS\Contract\QueryHandler;

class GetSignedDocumentQueryHandler implements QueryHandler
{
    public function __construct(
        private SignedDocumentReadModelRepositoryInterface $signedDocumentReadModelRepository
    ) {
    }

    public function __invoke(GetSignedDocumentQueryMessage $message): SignedDocument
    {
        /** @var GetSignedDocumentDTO $dto */
        $dto = $message->getGetSignedDocumentDTO();

        return $this->signedDocumentReadModelRepository->getSignedDocument(
            $dto->getRequestUrl(),
            $dto->getRequestWideId(),
            $dto->getAuthSubject(),
            $dto->getExtra()
        );
    }
}
