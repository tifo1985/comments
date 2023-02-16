<?php

declare(strict_types=1);

namespace App\Comments\Domain\Event;

use App\Shared\Domain\Event\DomainEventInterface;
use Symfony\Contracts\EventDispatcher\Event;

final class CommentCreatedEvent extends Event implements DomainEventInterface
{
    private \DateTimeImmutable $occurredOn;

    public function __construct(
        string $id,
        private readonly string $message,
        private readonly null|string $parentId,
        private readonly null|string $externalContentId
    ) {
        $this->occurredOn = new \DateTimeImmutable();
    }

    public static function eventName(): string
    {
        return 'comment.created';
    }

    public function message(): string
    {
        return $this->message;
    }

    public function parentId(): null|string
    {
        return $this->parentId;
    }

    public function externalContentId(): null|string
    {
        return $this->externalContentId;
    }

    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
