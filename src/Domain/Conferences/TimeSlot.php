<?php

namespace Metinet\Domain\Conferences;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class TimeSlot
{
    /**
     * @ORM\Column(type="conference_time")
     */
    private $start;

    /**
     * @ORM\Column(type="conference_time")
     */
    private $end;

    public function __construct(Time $start, Time $end)
    {
        // check if $start is greater than $end

        $this->start = $start;
        $this->end = $end;
    }

    public function getStart(): Time
    {
        return $this->start;
    }

    public function getEnd(): Time
    {
        return $this->end;
    }

    public function getDuration(): Time
    {
        $startDate = $this->getDateTimeFromTime($this->start);
        $endDate = $this->getDateTimeFromTime($this->end);
        $dateDiff = $endDate->diff($startDate);

        return new Time($dateDiff->h, $dateDiff->i, $dateDiff->s);
    }

    private function getDateTimeFromTime(Time $time): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('1970-01-01 %s', $time));
    }
}
