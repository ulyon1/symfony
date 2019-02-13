<?php

namespace Metinet\Conferences;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Metinet\JobBoard\DoctrineJobRepository")
 */
class Conference
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Embedded(class="ConferenceDetails")
     */
    private $details;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $date;

    /**
     * @ORM\Embedded(class="Location")
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxAttendees;

    /**
     * @ORM\Column(type="object")
     */
    private $attendees;

    /**
     * @ORM\Column(type="object")
     */
    private $registrationRule;

    /**
     * @ORM\Embedded(class="TimeSlot")
     */
    private $timeSlot;

    public function __construct(string $id, ConferenceDetails $details, Date $date, TimeSlot $timeSlot,
        Location $location, int $maxAttendees, RegistrationRule $registrationRule)
    {
        $this->id = $id;
        $this->details = $details;
        $this->date = $date->toDateTimeImmutable();
        $this->timeSlot = $timeSlot;
        $this->location = $location;
        $this->maxAttendees = $maxAttendees;
        $this->attendees = [];
        $this->registrationRule = $registrationRule;
    }

    public function register(Attendee $attendee): void
    {
        $this->ensureConferenceHasNotReachedMaxAttendees();
        $this->attendees[] = $attendee;
    }

    private function ensureConferenceHasNotReachedMaxAttendees(): void
    {
        if ($this->hasMaxAttendeesBeenReached()) {

            throw new MaxAttendeesReached($this->maxAttendees);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDetails(): ConferenceDetails
    {
        return $this->details;
    }

    public function getDate(): Date
    {
        return Date::fromDateTimeImmutable($this->date);
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function getMaxAttendees(): int
    {
        return $this->maxAttendees;
    }

    public function hasMaxAttendeesBeenReached(): bool
    {
        return ($this->maxAttendees <= \count($this->attendees));
    }

    public function areExternalPeopleAllowed(): bool
    {
        return $this->registrationRule->areExternalPeopleAllowed();
    }

    public function getExternalPeopleEntrancePrice(): ?Price
    {
        return $this->registrationRule->getExternalPeopleEntrancePrice();
    }

    public function getDuration(): Time
    {
        return $this->timeSlot->getDuration();
    }
}
