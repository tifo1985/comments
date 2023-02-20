<?php

declare(strict_types=1);

namespace App\UserInterface\Security;

use App\Domain\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class FacebookUser implements UserInterface
{
    private User $user;

    public function __construct(string $id, string $email, string $name, $avatar)
    {
        $this->user = (new User())
            ->setId($id)
            ->setEmail($email)
            ->setName($name)
            ->setAvatar($avatar);
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
        return $this->user->getEmail();
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
