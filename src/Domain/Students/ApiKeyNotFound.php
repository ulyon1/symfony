<?php

namespace Metinet\Domain\Students;

class ApiKeyNotFound extends \Exception
{
    public function __construct()
    {
        parent::__construct('Api Key not found');
    }
}
