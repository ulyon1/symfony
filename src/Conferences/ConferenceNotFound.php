<?php

namespace Metinet\Conferences;

class ConferenceNotFound extends \DomainException
{
    public function __construct(string $id)
    {
        parent::__construct(sprintf('Conference #%s not found', $id));
    }
}
