<?php

declare(strict_types=1);

namespace App\UserInterface\ViewModel;

final class ArticleViewModel
{
    use HeaderViewModelTrait;

    public function __construct(private readonly array $article)
    {
    }

    public function display(): array
    {
        return [
            'header' => $this->getHeaderInfo(),
            'article' => $this->article,
        ];
    }
}
