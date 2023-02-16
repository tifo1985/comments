<?php

namespace App\UserInterface\ViewModel;

use App\Domain\Entity\Comment;
use App\Domain\Response\CommentResponse;

class CommentViewModel
{
    public function __construct(readonly private CommentResponse $commentResponse) {}

    public function display(): array
    {
        return [
            'comments' => array_map(fn(Comment $comment) => $this->displayComment($comment) , $this->commentResponse->getComments()),
            'article_id' => $this->commentResponse->getArticleId(),
        ];
    }

    private function displayComment(Comment $comment): array
    {
        return [
            'id' => $comment->getId(),
            'replay_display' => false,
            'image' => 'https://i.imgur.com/stD0Q19.jpg',
            'date' => $comment->getCreatedAt()->format('d/m/Y H:i'),
            'message' => $comment->getMessage(),
            'author' => 'Ellouze Abdellatif',
            'children' => array_map(fn($comment) => $this->displayComment($comment), $comment->getChildren())
        ];
    }
}