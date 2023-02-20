<?php

declare(strict_types=1);

namespace App\Domain\Response;

class ArticleListingResponse
{
    public function __construct(private readonly array $articles)
    {
    }

    public function getArticles(): array
    {
        return $this->articles;
    }
}
