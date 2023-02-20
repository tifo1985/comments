<?php

declare(strict_types=1);

namespace App\Service\Jwt;

interface JwtDecoderInterface
{
    public function decode(string $token): array;
}
