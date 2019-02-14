<?php

namespace Metinet\App\Command;

use Metinet\Domain\Students\ApiKeyGenerator;
use Metinet\Domain\Students\ApiKeyManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateStudentApiKeyCommand extends Command
{
    private $apiKeyManager;
    private $apiKeyGenerator;

    public function __construct(ApiKeyManager $apiKeyManager, ApiKeyGenerator $apiKeyGenerator)
    {
        $this->apiKeyGenerator = $apiKeyGenerator;
        $this->apiKeyManager = $apiKeyManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('metinet:students:create-api-key')
            ->setDescription('Create an Api key associated to a Student')
            ->addArgument('studentId', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $studentId = $input->getArgument('studentId');
        $apiKey = $this->apiKeyGenerator->generate();

        $this->apiKeyManager->createStudentApiKey($studentId, $apiKey);

        $io = new SymfonyStyle($input, $output);
        $io->success(
            sprintf('Successfully created api key for student (id: %s, apikey: %s)', $studentId, $apiKey)
        );

        return 0;
    }
}
