<?php

namespace App\Api\Import\Reader;

interface ReaderInterface
{
    public function read(): void;

    public function getData(): array;

    public function validate(array $data): bool;

    public function renameIndexes(array $data): array;
}
