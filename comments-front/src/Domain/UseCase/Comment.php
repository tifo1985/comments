<?php

namespace App\Domain\UseCase;

use App\Domain\Gateway\CommentGateway;
use App\Domain\Request\CommentRequest;
use App\Domain\Response\CommentResponse;

class Comment
{
    public function __construct(readonly private CommentGateway $commentGateway) {}

    public function execute(CommentRequest $commentRequest): CommentResponse
    {
        $comments = $this->commentGateway->findByArticle($commentRequest->getArticleId(), $commentRequest->getMaxResult());

        return new CommentResponse($comments, $commentRequest->getArticleId());
    }
}