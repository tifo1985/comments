<?php

declare(strict_types=1);

namespace App\Domain\Request;

class ArticleRequest
{
    public function __construct(
        readonly private string $uuid
    ) {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
