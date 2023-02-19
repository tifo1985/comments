<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\ArticleListingPresenterInterface;
use App\Domain\Presenter\ArticlePresenterInterface;
use App\Domain\Response\ArticleListingResponse;
use App\Domain\Response\ArticleResponse;
use App\UserInterface\Traits\TokenStorageTraits;
use App\UserInterface\ViewModel\ArticleListingViewModel;
use App\UserInterface\ViewModel\ArticleViewModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class ArticleListingPresenter extends PresenterAbstract implements ArticleListingPresenterInterface
{
    use TokenStorageTraits;

    public function present(ArticleListingResponse $articleListingResponse): Response
    {
        $articleListingViewModel = new ArticleListingViewModel($articleListingResponse->getArticles());
        $articleListingViewModel->setUser($this->getUser());

        $response = new Response();

        return $response->setContent($this->twig->render('index.html.twig', [
            'articleViewModel' => $articleListingViewModel->display(),
        ]));
    }
}