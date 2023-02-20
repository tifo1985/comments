<?php

declare(strict_types=1);

namespace App\Domain\Presenter;

use App\Domain\Response\SendCommentResponse;
use Symfony\Component\HttpFoundation\Response;

interface SendCommentPresenterInterface
{
    public function present(SendCommentResponse $sendCommentResponse): Response;
}
