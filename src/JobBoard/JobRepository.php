<?php

namespace Metinet\JobBoard;

interface JobRepository
{
    public function save(Job $job): void;
}
