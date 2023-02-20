<?php

declare(strict_types=1);

namespace App\UserInterface\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

final class PreviousPageGenerator
{
    private const EXCLUDED_ROUTES = [
        'facebook_login',
    ];

    public const PREVIOUS_PAGE_KEY = 'previous-page';

    public function __construct(
        readonly private UrlGeneratorInterface $urlGenerator,
        readonly private RouterInterface $router
    ) {
    }

    public function generateOnSession(Request $request): void
    {
        $url = $this->generateUrl($request);
        if ($url) {
            $request->getSession()->set(self::PREVIOUS_PAGE_KEY, $url);
        }
    }

    private function generateUrl(Request $request): ?string
    {
        if (!$this->support($request)) {
            return null;
        }

        $previousPage = filter_var($request->headers->get('referer'), \FILTER_SANITIZE_URL);

        return empty($previousPage) ? $this->urlGenerator->generate('index') : $previousPage;
    }

    private function support(Request $request): bool
    {
        $url = parse_url($request->headers->get('referer'));
        if (!\array_key_exists('path', $url)) {
            return false;
        }

        try {
            $route = $this->router->match($url['path']);
        } catch (\Exception $exception) {
            return false;
        }

        return !($this->isExcludedRoute($route) || $this->isNotSupportedMethod($request));
    }

    private function isExcludedRoute($route): bool
    {
        return \in_array($route['_route'] ?? null, self::EXCLUDED_ROUTES, true);
    }

    private function isNotSupportedMethod(Request $request): bool
    {
        return !$request->isMethod('GET') || ($request->isMethod('GET') && $request->query->count());
    }
}
