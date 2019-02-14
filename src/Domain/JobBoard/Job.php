<?php

namespace Metinet\Domain\JobBoard;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Metinet\JobBoard\DoctrineJobRepository")
 */
class Job
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     */
    private $softSkills;

    /**
     * @ORM\Column(type="array")
     */
    private $hardSkills;

    /**
     * @ORM\Column(type="string")
     */
    private $contractType;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $publicationDate;

    public static function publish(string $id, string $title, string $description, array $softSkills, array $hardSkills,
        string $contractType, \DateTimeImmutable $publicationDate): self
    {
        return new static($id, $title, $description, $softSkills, $hardSkills, $contractType, $publicationDate);
    }

    private function __construct(string $id, string $title, string $description, array $softSkills, array $hardSkills,
        string $contractType, \DateTimeImmutable $publicationDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->softSkills = $softSkills;
        $this->hardSkills = $hardSkills;
        $this->contractType = $contractType;
        $this->publicationDate = $publicationDate;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSoftSkills(): array
    {
        return $this->softSkills;
    }

    public function getHardSkills(): array
    {
        return $this->hardSkills;
    }

    public function getContractType(): string
    {
        return $this->contractType;
    }

    public function getPublicationDate(): \DateTimeImmutable
    {
        return $this->publicationDate;
    }
}
