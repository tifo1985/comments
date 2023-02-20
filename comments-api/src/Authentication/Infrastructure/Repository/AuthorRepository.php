<?php

namespace App\Authentication\Infrastructure\Repository;

use App\Authentication\Domain\Entity\Author;
use App\Authentication\Domain\Repository\AuthorRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class AuthorRepository extends ServiceEntityRepository implements AuthorRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function findById(string $authorId): ?Author
    {
        return $this->_em->find(Author::class, $authorId);
    }

    public function create(Author $author): Author
    {
        $this->_em->persist($author);
        $this->_em->flush($author);

        return $author;
    }
}
