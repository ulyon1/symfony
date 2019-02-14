<?php

namespace Metinet\Domain\Students;

interface ApiKeyGenerator
{
    public function generate(): string;
}
