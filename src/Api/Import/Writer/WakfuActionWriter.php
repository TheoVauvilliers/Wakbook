<?php

namespace App\Api\Import\Writer;

use App\Entity\WakfuAction;
use App\Entity\WakfuEntityInterface;

class WakfuActionWriter extends AbstractDatabaseWriter
{
    protected function getEntityName(): string
    {
        return WakfuAction::class;
    }

    protected function getFindOneParams(): ?array
    {
        return [WakfuEntityInterface::ID];
    }
}
