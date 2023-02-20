<?php

declare(strict_types=1);

namespace App\Comments\Application\Controller;

use App\Comments\Application\Model\CreateCommentCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/comments/', name: 'api_comment_post', methods: ['POST'])]
final class CreateCommentController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus, readonly private SerializerInterface $serializer)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $parameters = \json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $createCommentCommand = new CreateCommentCommand(
                $parameters['message'] ?? '',
                $parameters['external_content_id'] ?? '',
                $parameters['parent_id'] ?? null
            );

            return $this->json($this->handle($createCommentCommand), Response::HTTP_CREATED);
        } catch (\Throwable $exception) {
            /** TODO monitoring */
            throw $exception;
        }
    }
}
