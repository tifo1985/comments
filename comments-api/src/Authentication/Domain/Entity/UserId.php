<?php

declare(strict_types=1);

namespace App\Authentication\Domain\Entity;

use App\Shared\Domain\ValueObject\NotEmptyString;

final class UserId extends NotEmptyString
{
    public function isEquals(UserId $other): bool
    {
        return $this->getValue() === $other->getValue();
    }
}
