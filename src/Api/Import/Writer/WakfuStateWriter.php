<?php

namespace App\Api\Import\Writer;

use App\Entity\WakfuEntityInterface;
use App\Entity\WakfuState;

class WakfuStateWriter extends AbstractDatabaseWriter
{
    protected function getEntityName(): string
    {
        return WakfuState::class;
    }

    protected function getFindOneParams(): ?array
    {
        return [WakfuEntityInterface::ID];
    }
}
