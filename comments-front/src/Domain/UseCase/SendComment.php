<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Entity\Comment;
use App\Domain\Gateway\CommentGateway;
use App\Domain\Request\SendCommentRequest;
use App\Domain\Response\SendCommentResponse;

class SendComment
{
    public function __construct(readonly private CommentGateway $commentGateway)
    {
    }

    public function execute(SendCommentRequest $request): SendCommentResponse
    {
        $parentId = $request->getParentId();
        $comment = (new Comment())
            ->setMessage($request->getMessage())
            ->setArticleId($request->getArticleId())
            ->setAuthor($request->getUser());
        if ($parentId) {
            $comment->setParent((new Comment())->setId($parentId));
        }

        return new SendCommentResponse($this->commentGateway->create($comment));
    }
}
