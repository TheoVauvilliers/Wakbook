<?php

namespace App\Api\Import\Command;

use App\Api\Import\Enum\EndpointEnum;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:api:wakfu:import:equipment-item-type',
    description: 'Import from equipment-item-type endpoint.',
)]
final class WakfuEquipmentItemTypeCommand extends AbstractImportCommand
{
    protected function getEndpoint(): string
    {
        return EndpointEnum::EquipmentItemTypes->value;
    }
}
