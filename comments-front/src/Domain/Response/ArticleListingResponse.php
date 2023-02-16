<?php

namespace App\Domain\Response;
class ArticleListingResponse
{
    public function __construct(private array $articles) {}

    public function getArticles(): array
    {
        return $this->articles;
    }
}