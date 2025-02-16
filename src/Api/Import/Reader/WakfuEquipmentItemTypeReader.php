<?php

namespace App\Api\Import\Reader;

use App\Api\Import\Constant\ConfigConstant;
use App\Api\Import\Enum\EndpointEnum;
use App\Api\Import\Response\ResponseInterface;
use App\Api\Import\Response\WakfuEquipmentItemTypeResponse;
use App\Entity\WakfuEntityInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Optional;

class WakfuEquipmentItemTypeReader extends AbstractReader
{
    protected function getEndpoint(): string
    {
        return sprintf(ConfigConstant::WAKFU_API_URL, ConfigConstant::WAKFU_API_VERSION, EndpointEnum::EquipmentItemTypes->value);
    }

    protected function getConstraints(): ?Collection
    {
        return new Collection([
            WakfuEntityInterface::ID => new NotBlank(),
            'parent' => new Optional(),
            'equipmentPositions' => new NotBlank(),
            'equipmentDisabledPositions' => new Optional(),
            'recyclable' => new NotNull(),
            'visibleInAnimation' => new NotNull(),
            'title' => new NotBlank(),
        ], allowExtraFields: true);
    }

    protected function getIndexesToRenameOrUnset(): array
    {
        return [
            'id' => WakfuEntityInterface::ID,
            'parentId' => 'parent',
            'isRecyclable' => 'recyclable',
            'isVisibleInAnimation' => 'visibleInAnimation',
        ];
    }

    protected function getResponseClass(): ?ResponseInterface
    {
        return new WakfuEquipmentItemTypeResponse;
    }
}
