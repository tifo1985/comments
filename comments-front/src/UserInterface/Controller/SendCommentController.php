<?php

namespace App\UserInterface\Controller;

use App\Domain\Presenter\SendCommentPresenterInterface;
use App\Domain\Request\SendCommentRequest;
use App\Domain\UseCase\SendComment;
use App\UserInterface\Traits\TokenStorageTraits;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SendCommentController
{
    use TokenStorageTraits;

    public function __invoke(
        Request $request, SendComment $sendComment, SendCommentPresenterInterface $sendCommentPresenter): Response
    {
        $parameters = \json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $request = new SendCommentRequest(
            $parameters['message'],
            $parameters['parentId'],
            $parameters['articleId'],
            $this->getUser()
        );
        $response = $sendComment->execute($request);

        return $sendCommentPresenter->present($response);
    }
}