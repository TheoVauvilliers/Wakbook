<?php

namespace App\Api\Import\Processor;

use App\Api\Import\Reader\ReaderInterface;
use App\Api\Import\Writer\WriterInterface;

interface ProcessorInterface
{
    public function process(
        ReaderInterface $reader,
        WriterInterface $writer,
    ): bool;
}
