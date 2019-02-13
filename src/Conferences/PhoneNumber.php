<?php

namespace Metinet\Conferences;

class PhoneNumber
{
    private $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->ensureValidPhoneNumber($phoneNumber);

        $this->phoneNumber = $phoneNumber;
    }

    public function ensureValidPhoneNumber(string $phoneNumber): void
    {
        // throw new InvalidPhoneNumber();
    }

    public function __toString(): string
    {
        return $this->phoneNumber;
    }
}
