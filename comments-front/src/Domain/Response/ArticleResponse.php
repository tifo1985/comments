<?php

declare(strict_types=1);

namespace App\Domain\Response;

class ArticleResponse
{
    public function __construct(private readonly null|array $article)
    {
    }

    public function getArticle(): null|array
    {
        return $this->article;
    }
}
