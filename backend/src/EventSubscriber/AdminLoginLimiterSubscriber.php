<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\RateLimiter\RateLimiterFactory;

final class AdminLoginLimiterSubscriber implements EventSubscriberInterface
{
    public function __construct(private RateLimiterFactory $adminLoginLimiter)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => ['limit', 20]];
    }

    public function limit(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (!$event->isMainRequest() || $request->getPathInfo() !== '/api/admin/login' || !$request->isMethod('POST')) {
            return;
        }

        if ($this->adminLoginLimiter->create($request->getClientIp() ?? 'unknown')->consume()->isAccepted()) {
            return;
        }

        $event->setResponse(new JsonResponse(
            ['reason' => 'rate'],
            Response::HTTP_TOO_MANY_REQUESTS,
            ['Cache-Control' => 'no-store'],
        ));
    }
}
