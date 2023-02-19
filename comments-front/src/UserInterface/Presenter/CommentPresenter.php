<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\CommentPresenterInterface;
use App\Domain\Response\CommentResponse;
use App\UserInterface\Traits\TokenStorageTraits;
use App\UserInterface\ViewModel\CommentViewModel;
use Symfony\Component\HttpFoundation\Response;

class CommentPresenter extends PresenterAbstract implements CommentPresenterInterface
{
    use TokenStorageTraits;

    public function present(CommentResponse $commentResponse): Response
    {
        $commentViewModel = new CommentViewModel($commentResponse, $this->getUser());
        $response = new Response();

        return $response->setContent($this->twig->render('comments.html.twig', [
            'commentViewModel' => $commentViewModel->display(),
        ]));
    }
}