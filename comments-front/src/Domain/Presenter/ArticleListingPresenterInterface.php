<?php

namespace App\Domain\Presenter;

use App\Domain\Response\ArticleListingResponse;
use Symfony\Component\HttpFoundation\Response;

interface ArticleListingPresenterInterface
{
    public function present(ArticleListingResponse $articleListingResponse): Response;
}