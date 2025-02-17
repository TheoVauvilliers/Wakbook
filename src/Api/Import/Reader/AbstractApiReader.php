<?php

namespace App\Api\Import\Reader;

use Exception;

abstract class AbstractApiReader extends AbstractReader
{
    protected const string POST = 'POST';
    protected const string GET = 'GET';

    public function read(): void
    {
        $response = $this->client->request($this->getMethod(), $this->getUrl(), $this->getOptions());
        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            throw new Exception(sprintf('Failed to retrieve data, status code %s', $statusCode));
        }

        $responseClass = $this->getResponseClass();

        $this->data = $responseClass !== null ? $responseClass($response->toArray()) : $response->toArray();
    }

    abstract protected function getMethod(): string;

    abstract protected function getUrl(): string;

    abstract protected function getOptions(): array;
}
