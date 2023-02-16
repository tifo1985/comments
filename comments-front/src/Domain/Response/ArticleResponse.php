<?php

namespace App\Domain\Response;
class ArticleResponse
{
    public function __construct(private null|array $article) {}

    public function getArticle(): null|array
    {
        return $this->article;
    }
}