<?php

declare(strict_types=1);

namespace App\UserInterface\Controller;

use App\Domain\Presenter\ArticleListingPresenterInterface;
use App\Domain\UseCase\ListingArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class ListingArticleController extends AbstractController
{
    public function __invoke(ListingArticle $listingArticle, ArticleListingPresenterInterface $articleListingPresenter): Response
    {
        $response = $listingArticle->execute();

        return $articleListingPresenter->present($response);
    }
}
