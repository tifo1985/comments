<?php

namespace App\Comments\Infrastructure\Repository;

use App\Comments\Domain\Entity\Comment;
use App\Comments\Domain\Repository\CommentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CommentRepository extends ServiceEntityRepository implements CommentRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function findByExternalContentId(string $externalContentId): array
    {
        return $this->findBy(['externalContentId' => $externalContentId]);
    }

    public function save(Comment $comment): void
    {
        $this->_em->persist($comment);
        $this->_em->flush();
    }

    public function findById(string $commentId): ?Comment
    {
        return $this->_em->find(Comment::class, $commentId);
    }
}
