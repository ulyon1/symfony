<?php

namespace Metinet\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Faker\Generator;
use Faker\Provider\Base as FakerProvider;
use Metinet\Domain\JobBoard\Job;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = $this->initFaker();

        for ($i = 0; $i < 50; $i++) {
            $job = Job::publish(
                $faker->uuid,
                $faker->jobTitle,
                $faker->text,
                $faker->softSkills,
                $faker->hardSkills,
                $faker->contractType,
                \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 month'))
            );

            $manager->persist($job);
        }

        $manager->flush();
    }

    private function initFaker(): Generator
    {
        $faker = FakerFactory::create();

        $faker->addProvider(new class($faker) extends FakerProvider {

            private const SOFT_SKILLS = [
                'Able to listen',
                'Listening',
                'Negotiation',
                'Nonverbal communication',
                'Persuasion',
                'Presentation',
                'Public speaking',
                'Reading body language',
                'Storytelling',
                'Verbal communication',
                'Visual communication',
                'Writing reports and proposals',
                'Writing skills',
                'Conflict management',
                'Conflict resolution',
                'Deal-making',
                'Decision making',
                'Delegation',
                'Dispute resolution',
                'Facilitating',
                'Giving clear feedback',
                'Inspiring',
                'Leadership',
                'Management',
                'Managing difficult conversations',
                'Managing remote teams',
                'Managing virtual teams',
                'Meeting management',
                'Mentoring',
                'Motivating',
                'Project management',
                'Resolving issues',
                'Successful coaching',
                'Supervising',
                'Talent management',
                'Positive Attitude',
                'Confident',
                'Cooperative',
                'Courteous',
                'Energetic',
                'Enthusiastic',
                'Friendly',
                'High energy',
                'Honest',
                'Patient',
                'Respectable',
                'Respectful',
                'Sense of humor',
                'Work-life balance',
                'Teamwork',
                'Accept feedback',
                'Collaborative',
                'Customer service',
                'Dealing with difficult situations',
                'Dealing with office politics',
                'Disability awareness',
                'Diversity awareness',
                'Emotional intelligence',
                'Empathetic',
                'Establishing interpersonal relationships',
                'Dealing with difficult personalities',
                'Intercultural competence',
                'Interpersonal skills',
                'Influential',
                'Networking',
                'Persuasive',
                'Self-awareness',
                'Selling skills',
                'Social skills',
                'Team building',
                'Team player',
                'Work Ethic',
                'Attentive',
                'Business ethics',
                'Competitive',
                'Dedicated',
                'Dependable',
                'Following direction',
                'Highly organized',
                'Independent',
                'Making deadlines',
                'Motivated',
                'Multitasking',
                'Organization',
                'Perseverant',
                'Persistent',
                'Planning',
                'Proper business etiquette',
                'Punctual',
                'Reliable',
                'Resilient',
                'Results-oriented',
                'Scheduling',
                'Self-directed',
                'Self-monitoring',
                'Self-supervising',
                'Staying on task',
                'Strategic planning',
                'Time management',
                'Trainable',
                'Working well under pressure',
            ];

            private const CONTRACT_TYPES = [
                'Full-Time',
                'Part-Time',
                'Fixed-Term',
                'Agency',
                'Freelancer',
            ];

            private const HARD_SKILLS = [
                'PHP',
                'OOP',
                'EcmaScript',
                'C#',
                'Java',
                'SOLID',
                'XML',
                'Linux',
                'git',
                'Gimp',
                'CSS',
                'HTML',
                'React',
                'AngularJS',
                'VueJS',
            ];

            public function softSkills() {
                return static::randomElements(static::SOFT_SKILLS, static::randomDigitNotNull());
            }

            public function hardSkills() {
                return static::randomElements(static::HARD_SKILLS, static::randomDigitNotNull());
            }

            public function contractType() {
                return static::randomElement(static::CONTRACT_TYPES);
            }
        });

        return $faker;
    }
}
