<?php

namespace App\Api\Import\Transformer\WakfuEquipmentItemType;

use App\Api\Import\Transformer\AbstractEntityPostponedTransformer;
use App\Entity\WakfuEquipmentItemType;
use App\Entity\WakfuEquipmentPosition;

class WakfuEquipmentPositionTransformer extends AbstractEntityPostponedTransformer
{
    /**
     * @param WakfuEquipmentItemType $entity
     * @param ?array $data
     * @return void
     */
    public function transform(mixed $entity, mixed $data): void
    {
        $entity->setEquipmentPositions([]);

        if (empty($data)) {
            return;
        }

        foreach ($data as $name) {
            $wakfuEquipmentPosition = $this->find($name);

            if (!$wakfuEquipmentPosition instanceof WakfuEquipmentPosition) {
                $wakfuEquipmentPosition = (new WakfuEquipmentPosition())->setName($name);

                $this->entityManager->persist($wakfuEquipmentPosition);
            }

            $entity->addEquipmentPosition($wakfuEquipmentPosition);
        }
    }

    protected function getEntityName(): string
    {
        return WakfuEquipmentPosition::class;
    }

    protected function getCriteriaNames(): array
    {
        return ['name'];
    }
}
