<?php

namespace App\UserInterface\ViewModel;

class ArticleViewModel
{
    public function __construct(private array $article) {}

    public function getArticle(): array
    {
        return $this->article;
    }
}