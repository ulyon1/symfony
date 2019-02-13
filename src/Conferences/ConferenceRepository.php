<?php

namespace Metinet\Conferences;

interface ConferenceRepository
{
    public function save(Conference $conference): void;
    public function get(string $id): Conference;
    public function findConferenceByPostalCode(string $postalCode): array;
    public function getLastSubmittedConferences(): array;
}
