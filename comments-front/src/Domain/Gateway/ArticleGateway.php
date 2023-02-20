<?php

declare(strict_types=1);

namespace App\Domain\Gateway;

interface ArticleGateway
{
    public function findAll(): array;

    public function find(string $articleId): null|array;
}
