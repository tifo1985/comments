<?php

declare(strict_types=1);

namespace App\Domain\Request;

use App\Domain\Entity\User;

class SendCommentRequest
{
    public function __construct(
        readonly private string $message,
        readonly private string $parentId,
        readonly private string $articleId,
        readonly private User $user
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getParentId(): string
    {
        return $this->parentId;
    }

    public function getArticleId(): string
    {
        return $this->articleId;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
