<?php

namespace Metinet\App\Controller\Web;

use Metinet\Domain\Conferences\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ConferencesController extends Controller
{
    public function latestConferences(ConferenceRepository $conferenceRepository): Response
    {
    }
}
