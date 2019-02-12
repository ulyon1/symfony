<?php

namespace Metinet\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Metinet\Blog\BlogPost;
use Metinet\Blog\BlogPostRepository;

class BlogPostFixtures extends Fixture
{
    private $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepository)
    {
        $this->blogPostRepository = $blogPostRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $this->blogPostRepository->clear();

        $faker = FakerFactory::create();

        for ($i = 0; $i < 50; $i++) {
            $student = BlogPost::submit(
                $faker->uuid,
                $faker->sentence,
                $faker->paragraphs(4, true),
                $faker->slug,
                \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-1 week')),
                $faker->uuid
            );

            $this->blogPostRepository->save($student);
        }
    }
}
