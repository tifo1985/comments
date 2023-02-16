<?php

namespace App\Domain\Gateway;

interface ArticleGateway
{
    public function findAll(): array;
    public function find(string $articleId): null|array;
}