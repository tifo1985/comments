<?php

declare(strict_types=1);

namespace App\Domain\Presenter;

use App\Domain\Response\CommentResponse;

interface CommentPresenterInterface
{
    public function present(CommentResponse $commentResponse);
}
