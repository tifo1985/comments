<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\ArticlePresenterInterface;
use App\Domain\Response\ArticleResponse;
use App\UserInterface\Traits\TokenStorageTraits;
use App\UserInterface\ViewModel\ArticleViewModel;
use Symfony\Component\HttpFoundation\Response;

class ArticlePresenter extends PresenterAbstract implements ArticlePresenterInterface
{
    use TokenStorageTraits;

    public function present(ArticleResponse $articleResponse): Response
    {
        $articleViewModel = new ArticleViewModel($articleResponse->getArticle());
        $articleViewModel->setUser($this->getUser());

        $response = new Response();

        return $response->setContent($this->twig->render('article.html.twig', [
            'articleViewModel' => $articleViewModel->display(),
        ]));
    }
}
