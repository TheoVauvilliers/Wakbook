<?php

namespace App\Api\Import\Response;

class WakfuEquipmentItemTypeResponse implements ResponseInterface
{
    public function __invoke(array $data): array
    {
        $result = [];

        foreach ($data as $action) {
            $result[] = [
                ...$action['definition'],
                'title' => $action['title']['fr'] ?? null,
            ];
        }

        return $result;
    }
}
