<?php

namespace Metinet\Students;

class InMemoryStudentRepository implements StudentRepository
{
    private $students = [];

    public function get(int $id): Student
    {
        return $this->students[$id];
    }

    public function save(Student $student): void
    {
        $this->students[$student->getId()] = $student;
    }
}
