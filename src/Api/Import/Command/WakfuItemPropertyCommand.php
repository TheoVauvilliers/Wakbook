<?php

namespace App\Api\Import\Command;

use App\Api\Import\Enum\EndpointEnum;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:api:wakfu:import:item-property',
    description: 'Import from item-property endpoint.',
)]
final class WakfuItemPropertyCommand extends AbstractImportCommand
{
    protected function getEndpoint(): string
    {
        return EndpointEnum::ItemProperties->value;
    }
}
