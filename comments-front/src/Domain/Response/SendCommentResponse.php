<?php

declare(strict_types=1);

namespace App\Domain\Response;

use App\Domain\Entity\Comment;

class SendCommentResponse
{
    public function __construct(private readonly Comment $comment)
    {
    }

    public function getComment(): Comment
    {
        return $this->comment;
    }
}
