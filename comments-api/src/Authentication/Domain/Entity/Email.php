<?php

declare(strict_types=1);

namespace App\Authentication\Domain\Entity;

use App\Shared\Domain\ValueObject\NotEmptyString;

final class Email extends NotEmptyString
{
}