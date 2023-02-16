<?php

namespace App\UserInterface\ViewModel;

class ArticleListingViewModel
{
    public function __construct(private array $articles) {}

    public function getArticles(): array
    {
        return $this->articles;
    }
}