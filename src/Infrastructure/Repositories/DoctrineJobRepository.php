<?php

namespace Metinet\Infrastructure\Repositories;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Metinet\Domain\JobBoard\Job;
use Metinet\Domain\JobBoard\JobRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineJobRepository extends ServiceEntityRepository implements JobRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Job::class);
    }

    public function save(Job $job): void
    {
        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush($job);
    }
}
