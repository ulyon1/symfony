<?php

namespace Metinet\Domain\Conferences;

class Email
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

    public function equals(Email $email): bool
    {
        return $this->email === $email->email;
    }
}
