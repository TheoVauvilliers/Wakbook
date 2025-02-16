<?php

namespace App\Api\Import\Transformer\WakfuEquipmentItemType;

use App\Api\Import\Transformer\AbstractEntityPostponedTransformer;
use App\Entity\WakfuEquipmentItemType;
use App\Entity\WakfuEquipmentPosition;

class WakfuEquipmentDisabledPositionTransformer extends AbstractEntityPostponedTransformer
{
    /**
     * @param WakfuEquipmentItemType $entity
     * @param ?array $data
     * @return void
     */
    public function transform(mixed $entity, mixed $data): void
    {
        $entity->setEquipmentDisabledPosition([]);

        if (empty($data)) {
            return;
        }

        foreach ($data as $name) {
            $wakfuEquipmentDisabledPosition = $this->find($name);

            if (!$wakfuEquipmentDisabledPosition instanceof WakfuEquipmentPosition) {
                $wakfuEquipmentDisabledPosition = (new WakfuEquipmentPosition())->setName($name);

                $this->entityManager->persist($wakfuEquipmentDisabledPosition);
            }

            $entity->addEquipmentDisabledPosition($wakfuEquipmentDisabledPosition);
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
