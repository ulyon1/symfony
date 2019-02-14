<?php

namespace Metinet\Domain\Students;

class CannotCreateApiKey extends \Exception
{
    public static function anApiKeyAlreadyExists(): self
    {
        return new self('Cannot create an ApiKey because an ApiKey is already configured, reset it before to create a new one');
    }
}
