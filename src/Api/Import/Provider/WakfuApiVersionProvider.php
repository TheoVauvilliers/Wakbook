<?php

namespace App\Api\Import\Provider;

use App\Api\Import\Constant\ConfigConstant;
use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WakfuApiVersionProvider
{
    public function __construct(
        protected HttpClientInterface $client,
    ) {
    }

    public function getVersion(): string
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
