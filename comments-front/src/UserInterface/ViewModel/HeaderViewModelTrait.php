<?php

namespace App\UserInterface\ViewModel;

use App\Domain\Entity\User;

trait HeaderViewModelTrait
{
    private null|User $user;

    public function setUser(null|User $user): void
    {
        $this->user = $user;
    }

    protected function getHeaderInfo(): array
    {
        return [
            'is_authenticated_user' => !is_null($this->user),
        ];
    }
}
