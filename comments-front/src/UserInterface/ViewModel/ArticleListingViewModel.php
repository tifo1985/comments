<?php

namespace App\UserInterface\ViewModel;

class ArticleListingViewModel
{
    use HeaderViewModelTrait;

    public function __construct(private readonly array $articles) {}

    public function display(): array
    {
        return [
            'header' => $this->getHeaderInfo(),
            'articles' => $this->articles,
        ];
    }
}