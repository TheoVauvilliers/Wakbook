<?php

namespace App\Api\Import\Command;

use App\Api\Import\Enum\EndpointEnum;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:api:wakfu:import:state',
    description: 'Import from state endpoint.',
)]
final class WakfuStateCommand extends AbstractImportCommand
{
    protected function getEndpoint(): string
    {
        return EndpointEnum::States->value;
    }
}
