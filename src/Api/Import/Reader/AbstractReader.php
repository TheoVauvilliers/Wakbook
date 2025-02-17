<?php

namespace App\Api\Import\Reader;

use App\Api\Import\Response\ResponseInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractReader implements ReaderInterface
{
    protected array $data;

    public function __construct(
        protected LoggerInterface $logger,
        protected HttpClientInterface $client,
        protected ValidatorInterface $validator,
    ) {
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function validate(array $data): bool
    {
        if (!$this->getConstraints()) {
            return true;
        }

        $violations = $this->validator->validate($data, $this->getConstraints());

        if (\count($violations) > 0) {
            /** @var ConstraintViolationInterface $violation */
            foreach ($violations as $violation) {
                $this->logger->error(sprintf(
                    'For path %s and value %s, error : %s',
                    $violation->getPropertyPath(),
                    json_encode($violation->getInvalidValue()),
                    $violation->getMessage(),
                ));
            }

            return false;
        }

        return true;
    }

    public function renameIndexes(array $data): array
    {
        foreach ($this->getIndexesToRenameOrUnset() as $oldKey => $newKey) {
            if (!array_key_exists($oldKey, $data)) {
                continue;
            }

            if (null !== $newKey) {
                if (!\is_array($newKey)) {
                    $newKey = [$newKey];
                }

                foreach ($newKey as $key) {
                    $data[$key] = $data[$oldKey];
                }
            }

            unset($data[$oldKey]);
        }

        return $data;
    }

    abstract protected function getResponseClass(): ?ResponseInterface;

    abstract protected function getConstraints(): ?Collection;

    protected function getIndexesToRenameOrUnset(): array
    {
        return [];
    }
}
