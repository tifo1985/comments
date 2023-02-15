<?php

declare(strict_types=1);

namespace App\Comments\Domain\Entity;

use App\Comments\Domain\Event\CommentCreatedEvent;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;

class Comment extends AggregateRoot
{
    private readonly string $id;
    private readonly string $message;
    private readonly null|Comment $parent;
    private readonly \DateTimeImmutable $createdAt;
    private readonly string $externalContentId;

    private function __construct(Uuid $id, Message $message, null|Comment $parent, null|Uuid $externalContentId)
    {
        $this->id = $id->getValue();
        $this->message = $message->getValue();
        $this->parent = $parent;
        $this->createdAt = new \DateTimeImmutable('now');
        $this->externalContentId = $externalContentId?->getValue();
    }

    public static function create(Uuid $id, Message $message, null|Comment $parent, null|Uuid $externalContentId): self
    {
        $comment = new Comment($id, $message, $parent, $externalContentId);

        $comment->record(new CommentCreatedEvent(
            $comment->getId()->getValue(),
            $comment->getMessage()->getValue(),
            $comment->getParent()?->getId()->getValue(),
            $comment->getExternalContentId()?->getValue(),
        ));

        return $comment;
    }

    public function getId(): Uuid
    {
        return new Uuid($this->id);
    }

    public function getMessage(): Message
    {
        return new Message($this->message);
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getParent(): null|Comment
    {
        return $this->parent;
    }

    public function getExternalContentId(): null|Uuid
    {
        return new Uuid($this->externalContentId);
    }
}
