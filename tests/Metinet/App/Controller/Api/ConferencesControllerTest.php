<?php

namespace Metinet\Tests\Metinet\App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ConferencesControllerTest extends WebTestCase
{
    public function testConferencesApiIsNotAccessibleByAnonymousUsers()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/conferences');

        $this->assertSame(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
        $this->assertJsonStringEqualsJsonString(json_encode(
            ['error' => ['message' => 'Invalid credentials.'], 'httpStatusCode' => 401]
        ), $client->getResponse()->getContent());
    }
}
