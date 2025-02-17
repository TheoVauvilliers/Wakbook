<?php

namespace App\Api\Import\Reader;

use App\Api\Import\Constant\ConfigConstant;
use App\Api\Import\Enum\EndpointEnum;
use App\Api\Import\Response\WakfuActionResponse;
use App\Api\Import\Response\ResponseInterface;
use App\Entity\WakfuEntityInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Optional;

class WakfuActionReader extends AbstractReader
{
    protected function getEndpoint(): string
    {
        return sprintf(ConfigConstant::WAKFU_API_URL, ConfigConstant::WAKFU_API_VERSION, EndpointEnum::Actions->value);
    }

    protected function getConstraints(): ?Collection
    {
        return new Collection([
            WakfuEntityInterface::ID => new NotBlank(),
            'effect' => new NotBlank(),
            'description' => new Optional(),
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
        return new WakfuActionResponse;
    }
}
