<?php

namespace Metinet\Students;

interface StudentRepository
{
    public function get(int $id): Student;
    public function save(Student $student): void;
}
