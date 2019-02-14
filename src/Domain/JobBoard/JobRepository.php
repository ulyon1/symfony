<?php

namespace Metinet\Domain\JobBoard;

interface JobRepository
{
    public function save(Job $job): void;
}
