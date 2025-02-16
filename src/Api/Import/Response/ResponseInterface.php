<?php

namespace App\Api\Import\Response;

interface ResponseInterface
{
    public function __invoke(array $data): array;
}
