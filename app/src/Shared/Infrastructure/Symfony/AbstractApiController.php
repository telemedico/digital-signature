<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony;

use App\Shared\Infrastructure\CQRS\Contract\CommandBus;
use App\Shared\Infrastructure\CQRS\Contract\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractApiController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
        private RequestStack $requestStack,
        protected CommandBus $commandBus,
        protected QueryBus $queryBus
    ) {
    }

    protected function deserialize(string $className): object
    {
        $request = $this->requestStack->getMainRequest();
        try {
            $posts = $this->serializer->deserialize($request->getContent(), $className, 'json');
        } catch (MissingConstructorArgumentsException $argumentsException) {
            throw new BadRequestHttpException($argumentsException->getMessage());
        }

        $errors = $this->validator->validate($posts);
        if (count($errors) > 0) {
            $errorString = [];
            foreach ($errors as $error) {
                $errorString [] = $error->getMessage();
            }

            throw new BadRequestHttpException(implode("\n", $errorString));
        }

        return $posts;
    }
}
