<?php

declare(strict_types=1);

namespace App\Authentication\Domain\Repository;

use App\Authentication\Domain\Entity\Author;

interface AuthorRepositoryInterface
{
    public function findById(string $authorId): null|Author;

    public function create(Author $author): Author;
}
