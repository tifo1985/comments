<?php

namespace App\Domain\Presenter;

use App\Domain\Response\CommentResponse;

interface CommentPresenterInterface
{
    public function present(CommentResponse $commentResponse);
}