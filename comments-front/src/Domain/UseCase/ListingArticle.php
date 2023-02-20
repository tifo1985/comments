<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Gateway\ArticleGateway;
use App\Domain\Response\ArticleListingResponse;

class ListingArticle
{
    public function __construct(readonly private ArticleGateway $articleGateway)
    {
    }

    public function execute(): ArticleListingResponse
    {
        return new ArticleListingResponse($this->articleGateway->findAll());
    }
}
