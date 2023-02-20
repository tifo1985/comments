<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\SendCommentPresenterInterface;
use App\Domain\Response\SendCommentResponse;
use App\UserInterface\Traits\TokenStorageTraits;
use App\UserInterface\ViewModel\SendCommentViewModel;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class SendCommentPresenter implements SendCommentPresenterInterface
{
    use TokenStorageTraits;

    public function __construct(private readonly Environment $twig)
    {
    }

    public function present(SendCommentResponse $sendCommentResponse): Response
    {
        $sendCommentViewModel = new SendCommentViewModel($sendCommentResponse->getComment(), $this->getUser());
        $response = new Response();

        return $response->setContent($this->twig->render('send_comment.html.twig', [
            'sendCommentViewModel' => $sendCommentViewModel->display(),
        ]));
    }
}
