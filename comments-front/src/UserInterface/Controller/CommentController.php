<?php

namespace App\UserInterface\Controller;

use App\Domain\Presenter\CommentPresenterInterface;
use App\Domain\Request\CommentRequest;
use App\Domain\UseCase\Comment;
use Symfony\Component\HttpFoundation\Response;

class CommentController
{
    public function __invoke(Comment $comment, CommentPresenterInterface $commentPresenter, string $articleId, $maxResult = 0): Response
    {
        $request = new CommentRequest($articleId, $maxResult);

        $response = $comment->execute($request);

        return $commentPresenter->present($response);
    }
}