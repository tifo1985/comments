<?php

declare(strict_types=1);

namespace App\UserInterface\Traits;

use App\Domain\Entity\User;
use App\UserInterface\Security\FacebookUser;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait TokenStorageTraits
{
    protected TokenStorageInterface $tokenStorage;

    /** @required  */
    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    protected function getUser(): null|User
    {
        /** @var FacebookUser $facebookUser */
        $facebookUser = $this->tokenStorage->getToken()?->getUser();

        return $facebookUser?->getUser();
    }
}
