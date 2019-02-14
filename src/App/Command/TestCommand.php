<?php

namespace Metinet\App\Command;

use Metinet\Domain\Conferences\ConferenceRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    private $conferenceRepository;

    public function __construct(ConferenceRepository $conferenceRepository)
    {
        $this->conferenceRepository = $conferenceRepository;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('metinet:test')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        var_dump($this->conferenceRepository->getLastSubmittedConferences());

        return 0;
    }
}
