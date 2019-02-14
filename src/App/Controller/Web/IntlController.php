<?php

namespace Metinet\App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class IntlController extends Controller
{
    public function setLocale(Request $request, Session $session, string $locale): Response
    {
        $session->set('_locale', $locale);

        return new RedirectResponse($request->headers->get('referer', '/'));
    }
}
