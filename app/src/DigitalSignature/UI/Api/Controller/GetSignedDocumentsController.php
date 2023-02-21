<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Controller;

use App\DigitalSignature\Application\Query\DTO\GetSignedDocumentsDTO;
use App\DigitalSignature\Application\Query\Message\GetSignedDocumentsQueryMessage;
use App\DigitalSignature\Infrastructure\Transformer\Contract\ArrayOfSignedDocumentsToGetSignedDocumentsResponseTransformerInterface;
use App\DigitalSignature\UI\Api\Model\Input\GetSignedDocumentsRequest;
use App\Shared\Infrastructure\Symfony\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(self::ROUTE_URL, name: self::ROUTE_NAME, methods: Request::METHOD_GET)]
class GetSignedDocumentsController extends AbstractApiController
{
    public const ROUTE_NAME = 'get_signed_documents';
    public const ROUTE_URL = '/api/get-signed-documents';

    public function __invoke(
        ArrayOfSignedDocumentsToGetSignedDocumentsResponseTransformerInterface $transformer
    ): Response {
        /** @var GetSignedDocumentsRequest $request */
        $request = $this->deserialize(GetSignedDocumentsRequest::class);

        $dto = new GetSignedDocumentsDTO(
            $request->redirectUrl
        );

        $documents = $this->queryBus->handle(
            new GetSignedDocumentsQueryMessage($dto)
        );

        return new JsonResponse(
            $transformer->transform($documents)
        );
    }
}
