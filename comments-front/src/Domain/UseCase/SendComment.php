<?php

namespace App\Domain\UseCase;

use App\Domain\Gateway\CommentGateway;
use App\Domain\Request\SendCommentRequest;
use App\Domain\Entity\Comment;
use App\Domain\Response\SendCommentResponse;

class SendComment
{
    public function __construct(readonly private CommentGateway $commentGateway) {}

    public function execute(SendCommentRequest $request): SendCommentResponse
    {
        $parentId = $request->getParentId();
        $articleId = $request->getParentId();
        $comment = (new Comment())
            ->setMessage($request->getMessage())
            ->setArticleId($request->getArticleId());
        if ($parentId) {
            $comment->setParent(new Comment())->setId($parentId);
        }

        $this->commentGateway->create($comment);

        return new SendCommentResponse($this->commentGateway->create($comment));
    }
}