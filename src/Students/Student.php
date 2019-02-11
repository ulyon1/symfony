<?php

namespace Metinet\Students;

final class Student
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $yearOfEntry;

    public static function register(string $firstName, string $lastName, string $email, string $yearOfEntry): self
    {
        return new static($firstName, $lastName, $email, $yearOfEntry);
    }

    private function __construct(string $firstName, string $lastName, string $email, string $yearOfEntry)
    {
        $this->id = random_int(1, 9999999);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->yearOfEntry = $yearOfEntry;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getyearOfEntry(): string
    {
        return $this->yearOfEntry;
    }
}
