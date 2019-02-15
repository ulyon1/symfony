<?php

namespace Metinet\App\Translations;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class SetLocaleKernelListener
{
    private $defaultLocale;

    public function __construct(string $defaultLocale)
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event): void
    {
        $request = $event->getRequest();

        $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
    }
}
