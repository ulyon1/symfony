<?php

namespace Metinet\Conferences;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Location
{
    /**
     * @ORM\Column(type="string")
     */
    private $placeName;

    /**
     * @ORM\Embedded(class="PostalAddress")
     */
    private $address;

    public function __construct(string $placeName, PostalAddress $address)
    {
        $this->address = $address;
        $this->placeName = $placeName;
    }

    public function getPlaceName(): string
    {
        return $this->placeName;
    }

    public function getAddress(): PostalAddress
    {
        return $this->address;
    }
}
