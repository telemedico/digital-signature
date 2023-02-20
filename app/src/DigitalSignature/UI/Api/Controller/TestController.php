<?php

declare(strict_types=1);

namespace App\DigitalSignature\UI\Api\Controller;

use App\DigitalSignature\UI\Api\Model\TestModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(self::ROUTE_URL, name: self::ROUTE_NAME, methods: Request::METHOD_POST)]
class TestController extends AbstractController
{
    public const ROUTE_NAME = 'test';
    public const ROUTE_URL = '/api/test';

    public function __invoke(TestModel $addDocumentToSigning): Response
    {
        return new JsonResponse('');
    }
}
