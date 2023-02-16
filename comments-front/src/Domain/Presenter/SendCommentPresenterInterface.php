<?php

namespace App\Domain\Presenter;

use App\Domain\Request\SendCommentRequest;

interface SendCommentPresenterInterface
{
    public function present(SendCommentRequest $sendCommentRequest);
}