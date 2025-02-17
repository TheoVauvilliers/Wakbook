<?php

namespace App\Api\Import\Reader;

use App\Api\Import\Constant\ConfigConstant;
use App\Api\Import\Provider\WakfuApiVersionProvider;
use Psr\Log\LoggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractWakfuReader extends AbstractApiReader
{
    public function __construct(
        LoggerInterface $logger,
        HttpClientInterface $client,
        ValidatorInterface $validator,
        protected WakfuApiVersionProvider $wakfuApiVersionProvider,
    ) {
        parent::__construct($logger, $client, $validator);
    }

    abstract protected function getEndpoint(): string;

    protected function getUrl(): string
    {
        return sprintf(
            ConfigConstant::WAKFU_API_URL,
            $this->wakfuApiVersionProvider->getVersion(),
            $this->getEndpoint()
        );
    }

    protected function getMethod(): string
    {
        return self::GET;
    }

    protected function getOptions(): array
    {
        return [];
    }
}
