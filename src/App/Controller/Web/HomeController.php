<?php

namespace Metinet\App\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return $this->render('home/homepage.html.twig', ['name' => 'World']);
    }

    public function hello(string $name): Response
    {
        return $this->render('home/homepage.html.twig', ['name' => $name]);
    }
}
