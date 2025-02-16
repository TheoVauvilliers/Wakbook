<?php

namespace App\Api\Import\Reader;

use App\Api\Import\Constant\ConfigConstant;
use Exception;

abstract class AbstractWakfuReader extends AbstractReader
{
    abstract protected function getEndpoint(): string;

    protected function getUrl(): string
    {
        return sprintf(ConfigConstant::WAKFU_API_URL, $this->getVersion(), $this->getEndpoint());
    }

    protected function getVersion(): string
    {
        $response = $this->client->request('GET', ConfigConstant::WAKFU_API_VERSION_URL);
        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            throw new Exception(sprintf('Failed to retrieve version, status code %s', $statusCode));
        }

        $data = $response->toArray();

        $version = $data['version'] ?? null;

        if ($version === null) {
            throw new Exception(sprintf('Failed to retrieve version, status code %s', $version));
        }

        return $version;
    }
}
