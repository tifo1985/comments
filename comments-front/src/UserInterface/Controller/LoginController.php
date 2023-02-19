<?php

namespace App\UserInterface\Controller;

use App\UserInterface\Security\PreviousPageGenerator;
use League\OAuth2\Client\Provider\Facebook;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends AbstractController
{
    public function login(Facebook $facebook, PreviousPageGenerator $previousPageGenerator, Request $request): Response
    {
        $previousPageGenerator->generateOnSession($request);
        return new RedirectResponse($facebook->getAuthorizationUrl());
    }

    public function callback(Request $request): Response
    {
        return $this->redirect($request->getSession()->get(PreviousPageGenerator::PREVIOUS_PAGE_KEY));
    }
}