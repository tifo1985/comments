<?php

declare(strict_types=1);

namespace App\Comments\Application\Model;

class CreateCommentCommand
{
    public function __construct(
        readonly string $message,
        readonly string $externalContentId,
        readonly null|string $parentId
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getExternalContentId(): string
    {
        return $this->externalContentId;
    }

    public function getParentId(): null|string
    {
        return $this->parentId;
    }
}
