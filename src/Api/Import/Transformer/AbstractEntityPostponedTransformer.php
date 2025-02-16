<?php

namespace App\Api\Import\Transformer;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractEntityPostponedTransformer implements PostponedTransformerInterface
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {
    }

    abstract protected function getEntityName(): string;

    abstract protected function getCriteriaNames(): array;

    protected function find(mixed $data): mixed
    {
        return $this->entityManager->getRepository($this->getEntityName())->findOneBy($this->buildParams($data));
    }

    protected function buildParams(mixed $data): array
    {
        $params = [];

        foreach ($this->getCriteriaNames() as $paramName) {
            if (\is_array($data)) {
                $params[$paramName] = $data[$paramName] ?? null;
            } else {
                $params[$paramName] = $data ?? null;
            }
        }

        return $params;
    }
}
