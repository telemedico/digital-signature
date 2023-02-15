<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Controller;

use App\DigitalSignature\Application\Command\DTO\AddDocumentToSigningDTO;
use App\DigitalSignature\Application\Command\Message\AddDocumentToSigningCommandMessage;
use App\DigitalSignature\UI\Api\Model\AddDocumentToSigning;
use App\Shared\Infrastructure\CQRS\Contract\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(self::ROUTE_URL, name: self::ROUTE_NAME, methods: Request::METHOD_POST)]
class AddDocumentToSigningController extends AbstractController
{
    public const ROUTE_NAME = 'add_document_to_signing';
    public const ROUTE_URL = '/api/add-document-to-signing';

    public function __construct(
        private CommandBus $commandBus
    ) {
    }

    public function __invoke(AddDocumentToSigning $addDocumentToSigning): Response
    {
        $commandMessage = new AddDocumentToSigningCommandMessage(
            new AddDocumentToSigningDTO($addDocumentToSigning->name, 'b', 'c', 'd')
        );

        $this->commandBus->dispatch(
            $commandMessage
        );

        return new JsonResponse($commandMessage->getResponse());
    }
}
