<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\ArticleListingPresenterInterface;
use App\Domain\Presenter\ArticlePresenterInterface;
use App\Domain\Response\ArticleListingResponse;
use App\Domain\Response\ArticleResponse;
use App\UserInterface\ViewModel\ArticleListingViewModel;
use App\UserInterface\ViewModel\ArticleViewModel;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ArticleListingPresenter implements ArticleListingPresenterInterface
{

    public function __construct(private readonly Environment $twig) {}

    public function present(ArticleListingResponse $articleListingResponse): Response
    {
        $articleListingViewModel = new ArticleListingViewModel($articleListingResponse->getArticles());
        $response = new Response();

        return $response->setContent($this->twig->render('index.html.twig', [
            'articleViewModel' => $articleListingViewModel,
        ]));
    }
}