<?php

namespace Metinet\Domain\Students;

use Metinet\App\Forms\StudentRegistration as StudentRegistrationDto;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class StudentRegistration
{
    private $studentRepository;
    private $encoderFactory;

    public function __construct(StudentRepository $studentRepository, EncoderFactoryInterface $encoderFactory)
    {
        $this->studentRepository = $studentRepository;
        $this->encoderFactory = $encoderFactory;
    }

    public function register(StudentRegistrationDto $studentRegistration): void
    {
        $salt = sha1(random_bytes(10));

        $encodedPassword = $this->encoderFactory
            ->getEncoder(Student::class)
            ->encodePassword($studentRegistration->password, $salt)
        ;

        $student = Student::register(
            $studentRegistration->id,
            $studentRegistration->firstName,
            $studentRegistration->lastName,
            $encodedPassword,
            $salt,
            $studentRegistration->email,
            $studentRegistration->yearOfEntry
        );

        $this->studentRepository->save($student);
    }
}
