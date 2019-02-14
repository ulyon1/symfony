<?php

namespace Metinet\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Metinet\Domain\Conferences\Conference;
use Metinet\Domain\Conferences\ConferenceDetails;
use Metinet\Domain\Conferences\Date;
use Metinet\Domain\Conferences\Location;
use Metinet\Domain\Conferences\PostalAddress;
use Metinet\Domain\Conferences\Price;
use Metinet\Domain\Conferences\RegistrationRule;
use Metinet\Domain\Conferences\Time;
use Metinet\Domain\Conferences\TimeSlot;
use Ramsey\Uuid\Uuid;

class ConferenceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $conference = new Conference(
                (string) Uuid::uuid4(),
                new ConferenceDetails(
                    $faker->sentence,
                    $faker->paragraphs(4, true),
                    $faker->words
                ),
                Date::fromAtomFormat($faker->dateTimeBetween('+1 DAY', '+2 YEAR')->format('Y-m-d')),
                new TimeSlot(Time::fromString($faker->numberBetween(1, 11)), Time::fromString($faker->numberBetween(12, 23))),
                new Location(
                    $faker->words(3, true),
                    new PostalAddress(
                        $faker->streetAddress,
                        $faker->postcode,
                        $faker->city,
                        'France'
                    )
                ),
                $faker->randomDigitNotNull,
                RegistrationRule::allowExternalPeopleToRegisterToConference(Price::inLowestSubunit(1000, 'EUR', 100))
            );

            $manager->persist($conference);
        }

        $manager->flush();
    }
}
