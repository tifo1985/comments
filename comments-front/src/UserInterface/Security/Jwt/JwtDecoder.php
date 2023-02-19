<?php

namespace App\Service\Jwt;

final class JwtDecoder implements JWTDecoderInterface
{
    public function decode(string $token): array
    {
        $tokenParts = \explode('.', $token);

        $tokenHeader = !empty($tokenParts[0]) ? \base64_decode($tokenParts[0]) : '{}';
        $tokenPayload = !empty($tokenParts[1]) ? \base64_decode($tokenParts[1]) : '{}';

        return [
            'header' => \json_decode($tokenHeader, true, 512, JSON_THROW_ON_ERROR),
            'payload' => \json_decode($tokenPayload, true, 512, JSON_THROW_ON_ERROR),
        ];
    }
}
