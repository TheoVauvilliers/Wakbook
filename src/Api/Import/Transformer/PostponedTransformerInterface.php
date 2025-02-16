<?php

namespace App\Api\Import\Transformer;

interface PostponedTransformerInterface
{
    public function transform(mixed $entity, mixed $data): void;
}
