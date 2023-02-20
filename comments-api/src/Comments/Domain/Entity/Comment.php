<?php

declare(strict_types=1);

namespace App\Comments\Domain\Entity;

use App\Authentication\Domain\Entity\Author;
use App\Comments\Domain\Event\CommentCreatedEvent;
use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Common\Collections\Collection;

class Comment extends AggregateRoot implements \JsonSerializable
{
    private readonly string $id;
    private readonly string $message;
    private readonly null|Comment $parent;
    private null|Collection $children = null;
    private readonly \DateTimeImmutable $createdAt;
    private readonly null|string $externalContentId;
    private readonly null|Author $author;

    private function __construct(Uuid $id, Message $message, null|Comment $parent, null|Uuid $externalContentId, Author $author)
    {
        $this->id = $id->getValue();
        $this->message = $message->getValue();
        $this->parent = $parent;
        $this->createdAt = new \DateTimeImmutable('now');
        $this->externalContentId = $externalContentId?->getValue();
        $this->author = $author;
    }

    public static function create(Uuid $id, Message $message, null|Comment $parent, null|Uuid $externalContentId, Author $author): self
    {
        $comment = new Comment($id, $message, $parent, $externalContentId, $author);

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
        if (is_null($this->externalContentId)) {
            return null;
        }
        return new Uuid($this->externalContentId);
    }

    /** @return Comment[] */
    public function getChildren(): array
    {
        return $this->children;
    }

    /** @var null|Comment[] $children */
    public function setChildren(null|array $children): self
    {
        $this->children = $children;

        return $this;
    }

    public function addChildren(null|Comment $child): self
    {
        $this->children[] = $child;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->createdAt->format(DATE_ATOM),
            'message' => $this->message,
            'children' => $this->children,
            'external_content_id' => $this->externalContentId,
            'author' => [
                'name' => $this->author->name()->getValue(),
                'avatar' => $this->author->avatar()->getValue(),
                'email' => $this->author->email()->getValue(),
            ]
        ];
    }
}
