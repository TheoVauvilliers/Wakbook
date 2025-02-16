<?php

namespace App\Api\Import\Transformer;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractEntityTransformer implements TransformerInterface
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {
    }

    public function transform(mixed $value): mixed
    {
        if (empty($value)) {
            return null;
        }

        return $this->entityManager->getRepository($this->getEntityName())->findOneBy($this->buildParams($value));
    }

    abstract protected function getEntityName(): string;

    abstract protected function getCriteriaNames(): array;

    protected function buildParams(mixed $value): array
    {
        $params = [];

        foreach ($this->getCriteriaNames() as $paramName) {
            if (\is_array($value)) {
                $params[$paramName] = $value[$paramName] ?? null;
            } else {
                $params[$paramName] = $value ?? null;
            }
        }

        return $params;
    }
}
