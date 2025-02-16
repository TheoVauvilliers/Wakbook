<?php

namespace App\Api\Import\Writer;

use App\Entity\WakfuEntityInterface;
use App\Entity\WakfuItemProperty;

class WakfuItemPropertyWriter extends AbstractDatabaseWriter
{
    protected function getEntityName(): string
    {
        return WakfuItemProperty::class;
    }

    protected function getFindOneParams(): ?array
    {
        return [WakfuEntityInterface::ID];
    }
}
