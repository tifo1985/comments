<?php

declare(strict_types=1);

namespace App\Infrastructure\EventListener;

use App\UserInterface\Traits\TokenStorageTraits;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTCreatedListener
{
    use TokenStorageTraits;

    public function __construct(readonly private RequestStack $requestStack)
    {
    }

    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        $payload = $event->getData();
        $payload['id'] = $this->getUser()->getId();
        $payload['name'] = $this->getUser()->getName();
        $payload['avatar'] = $this->getUser()->getAvatar();

        $event->setData($payload);
    }
}
