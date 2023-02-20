<?php

declare(strict_types=1);

namespace App\Comments\Application\Controller;

use App\Comments\Application\Model\FindCommentsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contents/{externalContentId}/comments/', name: 'api_comment_get', methods: ['GET'])]
final class FindCommentsByExternalContentIdController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(string $externalContentId): JsonResponse
    {
        return $this->json($this->handle(new FindCommentsQuery($externalContentId)), Response::HTTP_OK);
    }
}
