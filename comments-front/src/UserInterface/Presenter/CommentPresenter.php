<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\CommentPresenterInterface;
use App\Domain\Response\CommentResponse;
use App\UserInterface\ViewModel\CommentViewModel;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class CommentPresenter implements CommentPresenterInterface
{
    public function __construct(private readonly Environment $twig) {}

    public function present(CommentResponse $commentResponse): Response
    {
        $commentViewModel = new CommentViewModel($commentResponse);
        $response = new Response();

        return $response->setContent($this->twig->render('comments.html.twig', [
            'commentViewModel' => $commentViewModel->display(),
        ]));
    }
}