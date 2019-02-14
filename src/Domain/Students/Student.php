<?php

namespace Metinet\Domain\Students;

use Symfony\Component\Security\Core\User\UserInterface;

final class Student implements UserInterface
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $yearOfEntry;
    private $encodedPassword;
    private $salt;
    private $apiKey;

    public static function register(string $id, string $firstName, string $lastName,
        string $encodedPassword, string $salt, string $email, string $yearOfEntry): self
    {
        return new static($id, $firstName, $lastName, $encodedPassword, $salt, $email, $yearOfEntry);
    }

    private function __construct(string $id, string $firstName, string $lastName,
        string $encodedPassword, string $salt, string $email, string $yearOfEntry)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->encodedPassword = $encodedPassword;
        $this->salt = $salt;
        $this->email = $email;
        $this->yearOfEntry = $yearOfEntry;
    }

    public function getId(): string
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

    public function getYearOfEntry(): string
    {
        return $this->yearOfEntry;
    }

    public function resetApiKey(): void
    {
        $this->apiKey = null;
    }

    public function createApiKey(string $key): void
    {
        if ($this->apiKey) {

            throw CannotCreateApiKey::anApiKeyAlreadyExists();
        }

        $this->apiKey = $key;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function getRoles(): array
    {
        $roles = ['ROLE_STUDENT'];
        if ($this->apiKey) {
            $roles[] = 'ROLE_STUDENT_WITH_API_KEY';
        }

        return $roles;
    }

    public function getPassword()
    {
        return $this->encodedPassword;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials() {}
}
