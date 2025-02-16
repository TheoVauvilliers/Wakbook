<?php

namespace App\Api\Import\Transformer;

interface TransformerInterface
{
    public function transform(mixed $value): mixed;
}
