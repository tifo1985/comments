<?php

declare(strict_types=1);

namespace App\Domain\Request;

class CommentRequest
{
    public function __construct(
        readonly private string $articleId,
        readonly private string $maxResult
    ) {
    }

    public function getArticleId(): string
    {
        return $this->articleId;
    }

    public function getMaxResult(): string
    {
        return $this->maxResult;
    }
}
