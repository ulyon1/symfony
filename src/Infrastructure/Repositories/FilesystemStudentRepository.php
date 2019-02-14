<?php

namespace Metinet\Infrastructure\Repositories;

use Metinet\Domain\Students\Student;
use Metinet\Domain\Students\StudentEmailAlreadyExists;
use Metinet\Domain\Students\StudentNotFound;
use Metinet\Domain\Students\StudentRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FilesystemStudentRepository implements StudentRepository, UserProviderInterface
{
    private $path;
    /** @var Student[] */
    private $students = [];

    public function __construct(string $dataPath)
    {
        $this->path = sprintf('%s/students.repository', $dataPath);
        $this->load();
    }

    public function loadUserByUsername($username)
    {
        foreach ($this->students as $student) {
            if ($username === $student->getEmail()) {

                return $student;
            }
        }

        throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class): bool
    {
        return $class instanceof Student;
    }

    public function save(Student $student): void
    {
        foreach ($this->students as $existingStudent) {
            if ($student->getEmail() === $existingStudent->getEmail()
                && $student->getId() !== $existingStudent->getId()) {

                throw new StudentEmailAlreadyExists();
            }
        }

        $this->students[$student->getId()] = $student;

        $this->commit();
    }

    public function get(string $id): Student
    {
        if (!isset($this->students[$id])) {

            throw new StudentNotFound($id);
        }

        return $this->students[$id];
    }

    private function load(): void
    {
        if (!file_exists($this->path)) {
            file_put_contents($this->path, serialize($this->students));
        }

        $this->students = unserialize(file_get_contents($this->path), [Student::class]);
    }

    private function commit(): void
    {
        file_put_contents($this->path, serialize($this->students));
    }
}
