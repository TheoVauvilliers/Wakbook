<?php

namespace App\Api\Import\Transformer\WakfuEquipmentItemType;

use App\Api\Import\Transformer\AbstractEntityTransformer;
use App\Entity\WakfuEntityInterface;
use App\Entity\WakfuEquipmentItemType;

class WakfuEquipmentItemTypeEntityTransformer extends AbstractEntityTransformer
{
    protected function getEntityName(): string
    {
        return WakfuEquipmentItemType::class;
    }

    protected function getCriteriaNames(): array
    {
        return [WakfuEntityInterface::ID];
    }
}
