<?php

namespace Metinet\App\Command;

use Metinet\Domain\Students\ApiKeyManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ResetStudentApiKeyCommand extends Command
{
    private $apiKeyManager;

    public function __construct(ApiKeyManager $apiKeyManager)
    {
        $this->apiKeyManager = $apiKeyManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('metinet:students:reset-api-key')
            ->setDescription('Reset a Student Api Key')
            ->addArgument('studentId', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $studentId = $input->getArgument('studentId');

        $this->apiKeyManager->resetStudentApiKey($studentId);

        $io = new SymfonyStyle($input, $output);
        $io->success(sprintf('Successfully reset student Api Key (id: %s)', $studentId));

        return 0;
    }
}
