<?php

namespace App\Api\Import\Command;

use App\Api\Import\Enum\EndpointEnum;

use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:api:wakfu:import:action',
    description: 'Import from action endpoint.',
)]
final class WakfuActionCommand extends AbstractImportCommand
{
    protected function getEndpoint(): string
    {
        return EndpointEnum::Actions->value;
    }
}
