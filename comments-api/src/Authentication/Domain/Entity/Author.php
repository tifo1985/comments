<?php

declare(strict_types=1);

namespace App\Authentication\Domain\Entity;

use App\Shared\Domain\Aggregate\AggregateRoot;
use Symfony\Component\Security\Core\User\UserInterface;

class Author extends AggregateRoot implements UserInterface
{
    private readonly string $id;
    private readonly string $email;
    private readonly string $name;
    private readonly string $avatar;

    public function __construct(UserId $id, Email $email, Name $name, Url $avatar)
    {
        $this->id = $id->getValue();
        $this->email = $email->getValue();
        $this->name = $name->getValue();
        $this->avatar = $avatar->getValue();
    }

    public function email(): Email
    {
        return new Email($this->email);
    }

    public function name(): Name
    {
        return new Name($this->name);
    }

    public function avatar(): Url
    {
        return new Url($this->avatar);
    }

    public function getId(): UserId
    {
        return new UserId($this->id);
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }
}
