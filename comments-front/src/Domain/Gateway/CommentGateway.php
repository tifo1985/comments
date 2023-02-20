<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

use App\Domain\Entity\Comment;

interface CommentGateway
{
    public function create(Comment $comment): Comment;

    public function findByArticle(string $articleId, int $maxResult): array;
}
