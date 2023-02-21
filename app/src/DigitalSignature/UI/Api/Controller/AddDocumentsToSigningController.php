<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Controller;

use App\DigitalSignature\Application\Command\Message\AddDocumentsToSigningCommandMessage;
use App\DigitalSignature\Infrastructure\Transformer\Contract\AddDocumentsToSigningRequestToAddDocumentsToSigningDTOTransformerInterface;
use App\DigitalSignature\UI\Api\Model\Input\AddDocumentsToSigningRequest;
use App\DigitalSignature\UI\Api\Model\Output\AddDocumentsToSigningResponse;
use App\Shared\Infrastructure\Symfony\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(self::ROUTE_URL, name: self::ROUTE_NAME, methods: Request::METHOD_POST)]
class AddDocumentsToSigningController extends AbstractApiController
{
    public const ROUTE_NAME = 'add_documents_to_signing';
    public const ROUTE_URL = '/api/add-documents-to-signing';

    public function __invoke(
        AddDocumentsToSigningRequestToAddDocumentsToSigningDTOTransformerInterface $transformer
    ): Response
    {
        $request = $this->deserialize(AddDocumentsToSigningRequest::class);

        $command = new AddDocumentsToSigningCommandMessage(
            $transformer->transform($request)
        );

        $this->commandBus->dispatch($command);

        return new JsonResponse(
            new AddDocumentsToSigningResponse($command->getRedirectUrl())
        );
    }
}
