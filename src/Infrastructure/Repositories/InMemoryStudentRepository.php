<?php

namespace Metinet\Infrastructure\Repositories;

use Metinet\Domain\Students\Student;
use Metinet\Domain\Students\StudentRepository;

class InMemoryStudentRepository implements StudentRepository
{
    private $students = [];

    public function get(string $id): Student
    {
        return $this->students[$id];
    }

    public function save(Student $student): void
    {
        $this->students[$student->getId()] = $student;
    }
}
