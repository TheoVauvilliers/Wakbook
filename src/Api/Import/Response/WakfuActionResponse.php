<?php

namespace App\Api\Import\Response;

class WakfuActionResponse implements ResponseInterface
{
    public function __invoke(array $data): array
    {
        $result = [];

        foreach ($data as $action) {
            $result[] = [
                'id' => $action['definition']['id'] ?? null,
                'effect' => $action['definition']['effect'] ?? null,
                'description' => $action['description']['fr'] ?? null,
            ];
        }

        return $result;
    }
}
