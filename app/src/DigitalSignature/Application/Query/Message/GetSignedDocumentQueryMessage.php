<?php

declare(strict_types=1);

namespace App\DigitalSignature\Application\Query\Message;

use App\DigitalSignature\Application\Query\DTO\GetSignedDocumentDTO;
use App\Shared\Infrastructure\CQRS\Contract\QueryMessage;

class GetSignedDocumentQueryMessage implements QueryMessage
{
    public function __construct
    (
        private GetSignedDocumentDTO $getSignedDocumentDTO
    ) {
    }

    public function getGetSignedDocumentDTO(): GetSignedDocumentDTO
    {
        return $this->getSignedDocumentDTO;
    }
}
