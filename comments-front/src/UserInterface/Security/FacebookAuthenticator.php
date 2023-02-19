<?php

namespace App\UserInterface\Security;

use League\OAuth2\Client\Provider\Facebook;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class FacebookAuthenticator extends AbstractAuthenticator
{
    public function __construct(readonly private Facebook $facebook) {}

    public function supports(Request $request): ?bool
    {
        return 'facebook_callback' === $request->get('_route');
    }

    public function authenticate(Request $request): Passport
    {
        try {
            $token = $this->facebook->getAccessToken('authorization_code', [
                'code' => $request->query->get('code'),
            ]);
            $facebookUser = $this->facebook->getResourceOwner($token);

            return new SelfValidatingPassport(new UserBadge(\json_encode($facebookUser->toArray())));
        } catch (\Throwable $exception) {

            throw new CustomUserMessageAuthenticationException('Authentication Failed');
        }
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // on success, let the request continue
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}