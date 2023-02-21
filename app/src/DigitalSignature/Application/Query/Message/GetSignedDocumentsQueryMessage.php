<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Query\Message;

use App\DigitalSignature\Application\Query\DTO\GetSignedDocumentsDTO;
use App\Shared\Infrastructure\CQRS\Contract\QueryMessage;

class GetSignedDocumentsQueryMessage implements QueryMessage
{
    private array $documents;

    public function __construct
    (
        private GetSignedDocumentsDTO $getSignedDocumentsDTO
    ) {
    }

    public function getGetSignedDocumentsDTO(): GetSignedDocumentsDTO
    {
        return $this->getSignedDocumentsDTO;
    }

    public function setDocuments(array $documents): GetSignedDocumentsQueryMessage
    {
        $this->documents = $documents;

        return $this;
    }

    public function getDocuments(): array
    {
        return $this->documents;
    }
}
