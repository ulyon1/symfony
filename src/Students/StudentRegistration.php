<?php

namespace Metinet\Students;

use Metinet\Students\Forms\StudentRegistration as StudentRegistrationDto;

class StudentRegistration
{
    private $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function register(StudentRegistrationDto $studentRegistration): void
    {
        $student = Student::register(
            $studentRegistration->firstName,
            $studentRegistration->lastName,
            $studentRegistration->email,
            $studentRegistration->yearOfEntry
        );

        $this->studentRepository->save($student);
    }
}
