<?php

namespace Metinet\Students;

interface StudentRepository
{
    public function get(string $id): Student;
    public function save(Student $student): void;
}
