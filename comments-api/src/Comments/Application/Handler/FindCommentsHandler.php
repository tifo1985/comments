<?php

declare(strict_types=1);

namespace App\Comments\Application\Handler;

use App\Comments\Application\Model\FindCommentsQuery;
use App\Comments\Domain\Repository\CommentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class FindCommentsHandler
{
    public function __construct(readonly private CommentRepositoryInterface $commentRepository)
    {
    }

    /** Comment[] */
    public function __invoke(FindCommentsQuery $findCommentsQuery): array
    {
        $externalContentId = $findCommentsQuery->getExternalContentId();

        return $this->commentRepository->findByExternalContentId($externalContentId);
    }
}
