<?php

namespace App\Domain\Presenter;

use App\Domain\Response\ArticleResponse;
use Symfony\Component\HttpFoundation\Response;

interface ArticlePresenterInterface
{
    public function present(ArticleResponse $articleResponse): Response;
}