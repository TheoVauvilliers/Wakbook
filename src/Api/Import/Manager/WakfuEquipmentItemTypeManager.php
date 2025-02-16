<?php

namespace App\Api\Import\Manager;

use App\Entity\WakfuEntityInterface;
use App\Entity\WakfuEquipmentItemType;
use Doctrine\ORM\EntityManagerInterface;

class WakfuEquipmentItemTypeManager
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {
    }

    public function loadParent(array $data): void
    {
        $repository = $this->entityManager->getRepository(WakfuEquipmentItemType::class);

        foreach ($data as $entityId => $parentWakfuId) {
            /** @var ?WakfuEquipmentItemType $entity */
            $entity = $repository->find($entityId);

            if (!$entity) {
                continue;
            }

            /** @var ?WakfuEquipmentItemType $parent */
            $parent = $repository->findOneBy([WakfuEntityInterface::ID => $parentWakfuId]);

            if (!$parent) {
                continue;
            }

            $entity->setParent($parent);
        }

        $this->entityManager->flush();
    }
}
