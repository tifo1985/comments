<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid implements \Stringable
{
    public function __construct(protected null|string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    public static function random(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Uuid $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    private function ensureIsValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new \InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }
}
