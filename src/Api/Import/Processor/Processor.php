<?php

namespace App\Api\Import\Processor;

use App\Api\Import\Component\InitializableInterface;
use App\Api\Import\Reader\ReaderInterface;
use App\Api\Import\Writer\WriterInterface;
use Psr\Log\LoggerInterface;

class Processor implements ProcessorInterface
{
    public function __construct(
        protected LoggerInterface $logger,
    ) {
    }

    public function process(ReaderInterface $reader, WriterInterface $writer): bool
    {
        $this->initialize($reader, $writer);

        $reader->read();

        /** @var array $data */
        foreach($reader->getData() as $data) {
            $data = $reader->renameIndexes($data);

            if ($reader->validate($data)) {
                $writer->write($data);
            }
        }

        $writer->end();

        return true;
    }

    protected function initialize(ReaderInterface $reader, WriterInterface $writer): void
    {
        if ($reader instanceof InitializableInterface) {
            $reader->initialize();
        }

        if ($writer instanceof InitializableInterface) {
            $writer->initialize();
        }
    }
}
