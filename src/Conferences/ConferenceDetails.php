<?php

namespace Metinet\Conferences;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class ConferenceDetails
{
    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="simple_array")
     */
    private $keywords;

    public function __construct(string $title, string $description, array $keywords)
    {
        $this->ensureValidTitle($title);
        $this->ensureValidDescription($description);
        $this->ensureAtLeastOneKeyword($keywords);

        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getKeywords(): array
    {
        return $this->keywords;
    }

    private function ensureValidTitle(string $title): void
    {
        if (strlen($title) < 10 || strlen($title) > 250) {

            throw new \InvalidArgumentException('Title must be between 10 & 250 characters');
        }
    }

    private function ensureValidDescription(string $description): void
    {
        if (strlen($description) < 100 || strlen($description) > 1000) {

            throw new \InvalidArgumentException('Description must be between 100  & 1000 characters');
        }
    }

    private function ensureAtLeastOneKeyword(array $keywords): void
    {
        if (count($keywords) < 1) {

            throw new \InvalidArgumentException('At least one keyword is required');
        }
    }
}
