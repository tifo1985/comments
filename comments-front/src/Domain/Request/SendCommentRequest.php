<?php

namespace App\Domain\Request;
class SendCommentRequest
{
    public function __construct(
        readonly private string $message,
        readonly private string $parentId,
        readonly private string $articleId
    ) {}

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
}