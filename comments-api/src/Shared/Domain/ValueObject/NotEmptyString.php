<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

abstract class NotEmptyString
{
    protected string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Does not allow empty value');
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
