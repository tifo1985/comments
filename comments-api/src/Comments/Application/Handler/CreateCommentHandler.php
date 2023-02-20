<?php

declare(strict_types=1);

namespace App\Comments\Application\Handler;

use App\Comments\Application\Exception\CommentNotFoundException;
use App\Comments\Application\Model\CreateCommentCommand;
use App\Comments\Domain\Entity\Comment;
use App\Comments\Domain\Entity\Message;
use App\Comments\Domain\Repository\CommentRepositoryInterface;
use App\Shared\Domain\ValueObject\Uuid as ValueObjectUuid;
use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[AsMessageHandler]
final class CreateCommentHandler
{
    public function __construct(
        readonly private CommentRepositoryInterface $commentRepository,
        readonly private EventDispatcherInterface $eventDispatcher,
        readonly private TokenStorageInterface $tokenStorage
    ) {}

    /**
     * @throws CommentNotFoundException
     */
    public function __invoke(CreateCommentCommand $createCommentCommand): Comment
    {
        $parentId = $createCommentCommand->getParentId();
        $externalContentId = $createCommentCommand->getExternalContentId();
        $parent = null;
        if (!is_null($parentId)) {
            $parent = $this->commentRepository->findById($parentId);
            if (is_null($parent)) {
                throw new CommentNotFoundException('comment with id "'.$parentId.'" not found');
            }
        }
        $externalContentId = $parent ? null : ($externalContentId ? new ValueObjectUuid($externalContentId): null);

        $comment = Comment::create(
            new ValueObjectUuid(Uuid::uuid4()->toString()),
            new Message($createCommentCommand->getMessage()),
            $parent,
            $externalContentId,
            $this->tokenStorage->getToken()->getUser()
        );

        $this->commentRepository->save($comment);

        foreach ($comment->pullDomainEvents() as $domainEvent) {
            $this->eventDispatcher->dispatch($domainEvent);
        }

        return $comment;
    }
}
