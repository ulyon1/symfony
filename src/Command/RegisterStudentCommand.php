<?php

namespace Metinet\Command;

use Metinet\Students\StudentRegistration;
use Metinet\Students\Forms\StudentRegistration as StudentRegistrationDto;
use Metinet\Students\StudentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegisterStudentCommand extends Command
{
    private $studentRegistration;
    private $validator;
    private $studentRepository;
    private const VALIDATION_ERROR = 1;

    public function __construct(StudentRegistration $studentRegistration, StudentRepository $studentRepository,
        ValidatorInterface $validator)
    {
        $this->studentRegistration = $studentRegistration;
        $this->validator = $validator;
        $this->studentRepository = $studentRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('metinet:students:register')
            ->setDescription('Interactively register a student')
            ->setAliases(['register'])
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $studentRegistration = new StudentRegistrationDto();
        $studentRegistration->firstName = $io->ask('First name');
        $studentRegistration->lastName = $io->ask('Last name');
        $studentRegistration->password = $io->askHidden('Password');
        $studentRegistration->email = $io->ask('Email');
        $studentRegistration->yearOfEntry = $io->ask('Year of entry');

        $violations = $this->validator->validate($studentRegistration);

        if (count($violations)) {
            /** @var ConstraintViolation $violation */
            foreach ($violations as $violation) {
                $io->error(sprintf('%s: %s', $violation->getPropertyPath(), $violation->getMessage()));
            }

            return static::VALIDATION_ERROR;
        }

        $this->studentRegistration->register($studentRegistration);

        $student = $this->studentRepository->get($studentRegistration->id);

        $io->table(
            ['Id', 'First Name', 'Last Name', 'Email', 'Encoded Password', 'Year Of Entry'],
            [[$student->getId(), $student->getFirstName(), $student->getLastName(), $student->getEmail(),
                $student->getPassword(), $student->getYearOfEntry()]]
        );
    }
}
