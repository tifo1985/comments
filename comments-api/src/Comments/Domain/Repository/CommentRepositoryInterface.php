<?php

declare(strict_types=1);

namespace App\Comments\Domain\Repository;

use App\Comments\Domain\Entity\Comment;

interface CommentRepositoryInterface
{
    public function findById(string $commentId): null|Comment;

    /** Comment[] */
    public function findByExternalContentId(string $externalContentId): array;

    public function save(Comment $comment): void;
}
