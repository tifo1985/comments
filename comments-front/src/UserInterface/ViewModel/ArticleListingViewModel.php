<?php

declare(strict_types=1);

namespace App\UserInterface\ViewModel;

final class ArticleListingViewModel
{
    use HeaderViewModelTrait;

    public function __construct(private readonly array $articles)
    {
    }

    public function display(): array
    {
        return [
            'header' => $this->getHeaderInfo(),
            'articles' => $this->articles,
        ];
    }
}
