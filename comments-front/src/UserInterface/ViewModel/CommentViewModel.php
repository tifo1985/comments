<?php

namespace App\UserInterface\ViewModel;

use App\Domain\Entity\Comment;
use App\Domain\Entity\User;
use App\Domain\Response\CommentResponse;
use Symfony\Component\Security\Core\User\UserInterface;

class CommentViewModel
{
    public function __construct(
        readonly private CommentResponse $commentResponse,
        readonly private null|User $user
    ) {}

    public function display(): array
    {
        return [
            'comments' => array_map(fn(Comment $comment) => $this->displayComment($comment) , $this->commentResponse->getComments()),
            'article_id' => $this->commentResponse->getArticleId(),
            'is_authenticated_user' => !is_null($this->user),
            'avatar' => $this->user?->getAvatar(),
        ];
    }

    private function displayComment(Comment $comment): array
    {
        return [
            'id' => $comment->getId(),
            'image' => $comment->getAuthor()->getAvatar(),
            'date' => $comment->getCreatedAt()->format('d/m/Y H:i'),
            'message' => $comment->getMessage(),
            'author' => $comment->getAuthor()->getName(),
            'children' => array_map(fn($comment) => $this->displayComment($comment), $comment->getChildren())
        ];
    }
}