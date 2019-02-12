<?php

namespace Metinet\Students;

class FilesystemStudentRepository implements StudentRepository
{
    private $path;
    private $students = [];

    public function __construct(string $dataPath)
    {
        $this->path = sprintf('%s/students.repository', $dataPath);
        $this->load();
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
