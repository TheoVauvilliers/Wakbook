<?php

namespace App\Api\Import\Response;

class WakfuStateResponse implements ResponseInterface
{
    public function __invoke(array $data): array
    {
        $result = [];

        foreach ($data as $state) {
            $result[] = [
                'id' => $state['definition']['id'] ?? null,
                'title' => $state['title']['fr'] ?? null,
            ];
        }

        return $result;
    }
}
