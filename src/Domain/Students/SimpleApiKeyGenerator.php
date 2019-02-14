<?php

namespace Metinet\Domain\Students;

class SimpleApiKeyGenerator implements ApiKeyGenerator
{
    public function generate(): string
    {
        return sha1(random_bytes(32));
    }
}
