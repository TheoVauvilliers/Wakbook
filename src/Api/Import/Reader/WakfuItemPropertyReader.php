<?php

namespace App\Api\Import\Reader;

use App\Api\Import\Enum\EndpointEnum;
use App\Api\Import\Response\ResponseInterface;
use App\Entity\WakfuEntityInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;

class WakfuItemPropertyReader extends AbstractWakfuReader
{
    protected function getEndpoint(): string
    {
        return EndpointEnum::ItemProperties->value;
    }

    protected function getConstraints(): ?Collection
    {
        return new Collection([
            WakfuEntityInterface::ID => new NotBlank(),
            'name' => new NotBlank(),
            'description' => new NotBlank(),
        ], allowExtraFields: true);
    }

    protected function getIndexesToRenameOrUnset(): array
    {
        return [
            'id' => WakfuEntityInterface::ID,
        ];
    }

    protected function getResponseClass(): ?ResponseInterface
    {
        return null;
    }
}
