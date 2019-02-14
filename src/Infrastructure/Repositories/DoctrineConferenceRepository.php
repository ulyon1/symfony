<?php

namespace Metinet\Infrastructure\Repositories;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Metinet\Domain\Conferences\Conference;
use Metinet\Domain\Conferences\ConferenceNotFound;
use Metinet\Domain\Conferences\ConferenceRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineConferenceRepository extends ServiceEntityRepository implements ConferenceRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Conference::class);
    }

    public function get(string $id): Conference
    {
        $conference = $this->find($id);

        if (!$conference) {

            throw new ConferenceNotFound($id);
        }

        return $conference;
    }

    public function findConferenceByPostalCode(string $postalCode): array
    {
        $qb = $this->createQueryBuilder('c');
        $query = $qb
            ->where(
                $qb->expr()->like('c.location.address.postalCode', ':postalCode')
            )
            ->getQuery()
        ;

        return $query->execute(['postalCode' => $postalCode]);
    }

    public function getLastSubmittedConferences(): array
    {
        $qb = $this->createQueryBuilder('c');
        $query = $qb
            ->orderBy('c.date')
            ->getQuery()
        ;

        return $query->execute();
    }

    public function save(Conference $conference): void
    {
        $this->getEntityManager()->persist($conference);
        $this->getEntityManager()->flush($conference);
    }
}
