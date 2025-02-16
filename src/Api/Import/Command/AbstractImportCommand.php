<?php

namespace App\Api\Import\Command;

use App\Api\Import\Processor\ProcessorInterface;
use App\Api\Import\Reader\ReaderInterface;
use App\Api\Import\Writer\WriterInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class AbstractImportCommand extends Command
{
    public function __construct(
        protected ProcessorInterface $processor,
        protected ReaderInterface $reader,
        protected WriterInterface $writer,
    ) {
        parent::__construct();
    }

    abstract protected function getEndpoint(): string;

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $endpoint = $this->getEndpoint();

        try {
            $this->processor->process($this->reader, $this->writer);
        } catch (\Exception $e) {
            $io->error(sprintf('Failed to import for %s endpoint. Error : %s', $endpoint, $e->getMessage()));
        }

        $io->success(sprintf('Import succesfully for %s endpoint', $endpoint));

        return Command::SUCCESS;
    }
}
