<?php

namespace App\Api\Import\Writer;

use App\Api\Import\Manager\WakfuEquipmentItemTypeManager;
use App\Entity\WakfuEntityInterface;
use App\Entity\WakfuEquipmentItemType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class WakfuEquipmentItemTypeWriter extends AbstractDatabaseWriter
{
    protected const int MAX_FLUSH = 1;

    protected array $postponedParent = [];

    public function __construct(
        EntityManagerInterface $entityManager,
        protected WakfuEquipmentItemTypeManager $equipmentItemTypeManager,
    ) {
        parent::__construct($entityManager);
    }

    /**
     * @throws ExceptionInterface
     */
    public function write(array $data): bool
    {
        $data = $this->removePostponedDataTransformersFields($data);

        $parentWakfuId = $data['parent'] ?? null;

        $data = $this->applyTransformers($data);
        /** @var WakfuEquipmentItemType $entity */
        $entity = $this->loadEntity($data);

        $this->applyPostponedTransformers($entity, $data);

        $this->save($entity);

        if ($entity->getParent() === null && $parentWakfuId !== null) {
            $this->postponedParent[$entity->getId()] = $parentWakfuId;
        }

        return true;
    }

    public function end(): void
    {
        parent::end();

        $this->equipmentItemTypeManager->loadParent($this->postponedParent);
    }

    protected function getEntityName(): string
    {
        return WakfuEquipmentItemType::class;
    }

    protected function getFindOneParams(): ?array
    {
        return [WakfuEntityInterface::ID];
    }
}
