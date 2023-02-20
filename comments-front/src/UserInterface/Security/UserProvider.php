<?php

declare(strict_types=1);

namespace App\UserInterface\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass(string $class)
    {
        return FacebookUser::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $userData = \json_decode($identifier, true);

        return new FacebookUser(
            $userData['id'],
            $userData['email'],
            $userData['name'],
            $userData['picture_url']
        );
    }
}
