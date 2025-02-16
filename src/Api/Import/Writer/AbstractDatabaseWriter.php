<?php

namespace App\Api\Import\Writer;

use App\Api\Import\Component\InitializableInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

abstract class AbstractDatabaseWriter extends AbstractWriter implements InitializableInterface
{
    protected const int MAX_FLUSH = 10;

    protected EntityRepository $repository;
    protected int $count = 0;

    public function __construct(
        protected EntityManagerInterface $entityManager,
    ) {
    }

    public function initialize(): void
    {
        $this->repository = $this->entityManager->getRepository($this->getEntityName());
    }

    /**
     * @throws ExceptionInterface
     */
    public function write(array $data): bool
    {
        $data = $this->removePostponedDataTransformersFields($data);

        $data = $this->applyTransformers($data);
        $entity = $this->loadEntity($data);
        $this->applyPostponedTransformers($entity, $data);

        $this->save($entity);

        return true;
    }

    abstract protected function getEntityName(): string;

    abstract protected function getFindOneParams(): ?array;

    /**
     * @throws ExceptionInterface
     */
    protected function loadEntity(array $data)
    {
        $data = $this->removeNullEntries($data);

        $normalizer = new ObjectNormalizer();

        if (empty($this->getFindOneParams())) {
            return $normalizer->denormalize($data, $this->getEntityName());
        }

        $existingEntity = $this->getExistingEntity($data);

        if (null !== $existingEntity) {
            $workingRecord = $this->removePostponedDataTransformersFields($data);

            return $normalizer->denormalize(
                $workingRecord,
                $this->getEntityName(),
                'array',
                ['object_to_populate' => $existingEntity]
            );
        }

        return $normalizer->denormalize($data, $this->getEntityName());
    }

    protected function removeNullEntries(array $data): array
    {
        foreach ($data as $key => $value) {
            if (null === $value) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    protected function getExistingEntity(array $data)
    {
        $params = $this->getFindOneParamsAsAssociativeArray($data);

        return $this->repository->findOneBy($params);
    }

    protected function getFindOneParamsAsAssociativeArray(array $data): array
    {
        $params = [];
        foreach ($this->getFindOneParams() as $item) {
            $params["{$item}"] = $data[$item];
        }

        return $params;
    }

    protected function save(object $entity): void
    {
        $this->entityManager->persist($entity);
        $this->count++;

        if ($this->count >= static::MAX_FLUSH) {
            $this->entityManager->flush();
            $this->entityManager->clear();

            $this->count = 0;
        }
    }

    public function end(): void
    {
        $this->entityManager->flush();
    }
}
