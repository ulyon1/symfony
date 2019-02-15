<?php

namespace Metinet\Tests\App;

use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker\Factory as FakerFactory;

class StudentRegistrationAndLoginWorkflowTest extends WebTestCase
{
    /**
     * @var Generator
     */
    private $faker;

    public function setUp()
    {
        $this->faker = FakerFactory::create();
    }

    public function testAStudentCanRegisterAndLogIn(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/students/register');

        $form = $crawler->selectButton('Register')->form();

        $studentFirstName = $this->faker->firstName;
        $studentLastName = $this->faker->lastName;
        $studentEmail = $this->faker->email;
        $studentPassword = $this->faker->password;
        $studentYearOfEntry = $this->faker->numberBetween(2000, 2018);

        $form['student_registration[firstName]'] = $studentFirstName;
        $form['student_registration[lastName]'] = $studentLastName;
        $form['student_registration[email]'] = $studentEmail;
        $form['student_registration[password][first]'] = $studentPassword;
        $form['student_registration[password][second]'] = $studentPassword;
        $form['student_registration[yearOfEntry]'] = $studentYearOfEntry;

        $client->submit($form);
        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $this->assertRegExp('@/students/profile/.*@', $client->getResponse()->headers->get('Location'));

        preg_match('@/students/profile/(.*)@', $client->getResponse()->headers->get('Location'), $matches);
        [,$studentId] = $matches;

        $client->followRedirect();

        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $this->assertRegExp('@/login@', $client->getResponse()->headers->get('Location'));

        $crawler = $client->followRedirect();

        $form = $crawler->selectButton('Login')->form();

        $form['_username'] = $studentEmail;
        $form['_password'] = $studentPassword;

        $client->submit($form);

        $this->assertSame(302, $client->getResponse()->getStatusCode());
        $this->assertRegExp('@/students/profile/.*@', $client->getResponse()->headers->get('Location'));

        $crawler = $client->followRedirect();

        $this->assertContains($studentFirstName, $crawler->filter('dd.student_profile_first_name')->text());
        $this->assertContains($studentLastName, $crawler->filter('dd.student_profile_last_name')->text());
        $this->assertContains($studentId, $crawler->filter('dd.student_profile_id')->text());
    }
}
