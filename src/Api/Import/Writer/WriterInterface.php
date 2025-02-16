<?php

namespace App\Api\Import\Writer;

interface WriterInterface
{
    public function write(array $data): bool;

    public function end(): void;
}
