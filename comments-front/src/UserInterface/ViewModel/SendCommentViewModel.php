<?php

namespace App\UserInterface\ViewModel;

use App\Domain\Entity\Comment;
use App\Domain\Entity\User;
use App\Domain\Response\CommentResponse;
use Symfony\Component\Security\Core\User\UserInterface;

class SendCommentViewModel
{
    public function __construct(
        readonly private Comment $comment,
        readonly private null|User $user
    ) {}

    public function display(): array
    {
        return [
            'avatar' => $this->user?->getAvatar(),
            'comment' => [
            'id' => $this->comment->getId(),
            'image' => $this->comment->getAuthor()->getAvatar(),
            'date' => $this->comment->getCreatedAt()->format('d/m/Y H:i'),
            'message' => $this->comment->getMessage(),
            'author' => $this->comment->getAuthor()->getName(),
            'children' => [],
            ]
        ];
    }
}