<?php

namespace App\Domain\Entity;

class Comment
{
    private string $id;
    private string $message;
    private null|Comment $parent = null;
    private string $articleId;
    /** @var Comment[] */
    private array $children;
    private null|\DateTime $createdAt = null;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getParent(): null|Comment
    {
        return $this->parent;
    }

    public function setParent(Comment $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getArticleId(): string
    {
        return $this->articleId;
    }

    public function setArticleId(string $articleId): self
    {
        $this->articleId = $articleId;

        return $this;
    }

    /** @return Comment[] */
    public function getChildren(): array
    {
        return $this->children;
    }

    /** @var Comment[] $children */
    public function setChildren(array $children): self
    {
        $this->children = $children;

        return $this;
    }

    public function getCreatedAt(): null|\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}