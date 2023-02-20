<?php

declare(strict_types=1);

namespace App\Domain\Response;

class CommentResponse
{
    public function __construct(readonly private array $comments, readonly private string $articleId)
    {
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function getArticleId(): string
    {
        return $this->articleId;
    }
}
