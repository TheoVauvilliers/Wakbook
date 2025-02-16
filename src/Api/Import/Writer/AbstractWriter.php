<?php

namespace App\Api\Import\Writer;

use App\Api\Import\Transformer\PostponedTransformerInterface;
use App\Api\Import\Transformer\TransformerInterface;
use Exception;

abstract class AbstractWriter implements WriterInterface
{
    protected const string POSTPONED_PREFIX = 'postponed_';

    /** @var TransformerInterface[] $transformers */
    protected array $transformers = [];

    /** @var PostponedTransformerInterface[] $transformers */
    protected array $postponedTransformers = [];

    /**
     * @throws Exception
     */
    public function setTransformers(array $transformers): static
    {
        foreach ($transformers as $transformer) {
            if (!($transformer instanceof TransformerInterface)) {
                throw new Exception('Invalid transformer has been passed: ' . $transformer::class);
            }
        }

        $this->transformers = $transformers;

        return $this;
    }

    /**
     * @throws Exception
     */
    public function setPostponedTransformers(array $postponedTransformers): static
    {
        foreach ($postponedTransformers as $postponedTransformer) {
            if (!($postponedTransformer instanceof PostponedTransformerInterface)) {
                throw new Exception('Invalid postponed transformer has been passed: ' . $postponedTransformer::class);
            }
        }

        $this->postponedTransformers = $postponedTransformers;

        return $this;
    }

    protected function applyTransformers(array $data): array
    {
        foreach ($this->transformers as $key => $transformer) {
            if (isset($data[$key])) {
                $data[$key] = $transformer->transform($data[$key]);
            }
        }

        return $data;
    }

    protected function applyPostponedTransformers(object $entity, array $data): void
    {
        foreach ($this->postponedTransformers as $key => $postponedTransformer) {
            if (isset($data[static::POSTPONED_PREFIX . $key])) {
                $postponedTransformer->transform($entity, $data[static::POSTPONED_PREFIX . $key]);
            }
        }
    }

    protected function removePostponedDataTransformersFields(array $data): array
    {
        foreach ($data as $key => $value) {
            if (isset($this->postponedTransformers[$key])) {
                $data[static::POSTPONED_PREFIX . $key] = $value;
                unset($data[$key]);
            }
        }

        return $data;
    }
}
