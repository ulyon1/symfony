<?php

namespace Metinet\Domain\Conferences;

class ConferenceNotFound extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Conference #%s not found', $id));
    }
}
