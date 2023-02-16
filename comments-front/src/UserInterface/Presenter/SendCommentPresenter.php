<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\SendCommentPresenterInterface;
use App\Domain\Request\SendCommentRequest;
use App\UserInterface\ViewModel\CommentViewModel;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class SendCommentPresenter implements SendCommentPresenterInterface
{
    public function __construct(private readonly Environment $twig) {}

    public function present(SendCommentRequest $sendCommentRequest): Response
    {
        $commentViewModel = new CommentViewModel($sendCommentRequest);
        $response = new Response();

        return $response->setContent($this->twig->render('comments.html.twig', [
            'commentViewModel' => $commentViewModel->display(),
        ]));
    }
}