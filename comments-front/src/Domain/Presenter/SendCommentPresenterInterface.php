<?php

namespace App\Domain\Presenter;

use App\Domain\Response\SendCommentResponse;

interface SendCommentPresenterInterface
{
    public function present(SendCommentResponse $sendCommentResponse);
}