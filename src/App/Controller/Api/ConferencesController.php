<?php

namespace Metinet\App\Controller\Api;

use Metinet\Domain\Conferences\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ConferencesController extends Controller
{
    public function latestConferences(ConferenceRepository $conferenceRepository, SerializerInterface $serializer): Response
    {
        $conferences = $conferenceRepository->getLastSubmittedConferences();

        return JsonResponse::fromJsonString($serializer->serialize($conferences, 'json'));
    }
}
