<?php

namespace Metinet\Students;

use Metinet\Domain\Members\StudentNotFound;

class FilesystemStudentRepository implements StudentRepository
{
    private $path;

    public function __construct(string $dataPath)
    {
        $this->path = $dataPath;
    }

    public function save(Student $student): void
    {
        file_put_contents(sprintf('%s/%s.student', $this->path, $student->getId()), serialize($student));
    }

    public function get($id): Student
    {
        $filename = sprintf('%s/%s.student', $this->path, $id);

        if (!is_file($filename)) {

            throw new StudentNotFound($id);
        }

        return unserialize(file_get_contents($filename), [Student::class]);
    }
}
