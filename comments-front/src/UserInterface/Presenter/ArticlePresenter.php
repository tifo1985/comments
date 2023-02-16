<?php

namespace App\UserInterface\Presenter;

use App\Domain\Presenter\ArticlePresenterInterface;
use App\Domain\Response\ArticleResponse;
use App\UserInterface\ViewModel\ArticleViewModel;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ArticlePresenter implements ArticlePresenterInterface
{

    public function __construct(private readonly Environment $twig) {}

    public function present(ArticleResponse $articleResponse): Response
    {
        $articleViewModel = new ArticleViewModel($articleResponse->getArticle());
        $response = new Response();

        return $response->setContent($this->twig->render('article.html.twig', [
            'articleViewModel' => $articleViewModel,
        ]));
    }
}