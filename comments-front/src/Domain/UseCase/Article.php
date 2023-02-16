<?php

namespace App\Domain\UseCase;

use App\Domain\Gateway\ArticleGateway;
use App\Domain\Request\ArticleRequest;
use App\Domain\Response\ArticleResponse;

class Article
{
    public function __construct(readonly private ArticleGateway $articleGateway) {}

    public function execute(ArticleRequest $articleRequest): ArticleResponse
    {
        return new ArticleResponse($this->articleGateway->find($articleRequest->getUuid()));
    }
}