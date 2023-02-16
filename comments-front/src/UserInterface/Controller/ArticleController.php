<?php

namespace App\UserInterface\Controller;

use App\Domain\Presenter\ArticlePresenterInterface;
use App\Domain\Request\ArticleRequest;
use App\Domain\UseCase\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    public function __invoke(Article $article, ArticlePresenterInterface $articlePresenter, string $articleId): Response
    {
        $request = new ArticleRequest($articleId);
        $response = $article->execute($request);
        if (is_null($response->getArticle())) {
            return new Response('Not Found', 404);
        }

        return $articlePresenter->present($response);
    }
}