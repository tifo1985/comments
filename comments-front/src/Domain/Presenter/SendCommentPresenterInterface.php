<?php

declare(strict_types=1);

namespace App\Domain\Presenter;

use App\Domain\Response\SendCommentResponse;

interface SendCommentPresenterInterface
{
    public function present(SendCommentResponse $sendCommentResponse);
}
