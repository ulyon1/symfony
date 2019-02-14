<?php

namespace Metinet\Domain\Students;

class ApiKeyManager
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function createStudentApiKey(string $studentId, string $apiKey): void
    {
        $student = $this->studentRepository->get($studentId);
        $student->createApiKey($apiKey);

        $this->studentRepository->save($student);
    }

    public function resetStudentApiKey(string $studentId): void
    {
        $student = $this->studentRepository->get($studentId);
        $student->resetApiKey();

        $this->studentRepository->save($student);
    }
}
