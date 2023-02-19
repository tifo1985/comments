<?php

namespace App\UserInterface\ViewModel;

class ArticleViewModel
{
    use HeaderViewModelTrait;
    public function __construct(private readonly array $article) {}

    public function display(): array
    {
        return [
            'header' => $this->getHeaderInfo(),
            'article' => $this->article,
        ];
    }
}