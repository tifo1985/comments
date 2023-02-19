<?php

namespace App\Service\Jwt;

interface JwtDecoderInterface
{
    public function decode(string $token): array;
}
