<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\Http\Client;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Phrase;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Http\Client\ClientFactoryInterface;
use SR\Gateway\Api\Http\Client\ClientInterface;
use SR\Gateway\Exception\ClientException;
use SR\Gateway\Model\Config\Config;
use SR\Gateway\Model\System\Config\Source\HttpClient;
use SR\Gateway\Model\Http\Client\Guzzle;
use SR\Gateway\Model\Http\Client\Rest;
use SR\Gateway\Model\Http\Client\Soap;

class ClientFactory implements ClientFactoryInterface
{
    protected ObjectManagerInterface $objectManager;
    protected ConfigInterface $config;

    /**
     * List of possible arguments which are passed into Client Adapter Object (on create instance)
     */
    protected array $clientArguments = [];

    /**
     * @param ObjectManagerInterface $objectManager
     * @param ConfigInterface $config
     * @param array $clientArguments
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        ConfigInterface $config,
        array $clientArguments = []
    ) {
        $this->objectManager    = $objectManager;
        $this->config           = $config;
        $this->clientArguments  = $clientArguments;
    }

    /**
     * @inheritDoc
     */
    public function create(array $subject, array $arguments = []): ClientInterface
    {
        $storeId = $subject['store_id'] ?? null;

        if (method_exists($this->config, 'getClient')) {
            $httpClientCode = $this->config->getClient($storeId);
        } else {
            $httpClientCode = $this->config->getValue(Config::KEY_CONFIG_HTTP_CLIENT, Config::DEFAULT_PATH_GROUP, $storeId) ?: null;
        }

        switch ($httpClientCode) {
            case HttpClient::REST:
                return $this->objectManager->create(Rest::class, $this->clientArguments);

            case HttpClient::SOAP:
                return $this->objectManager->create(Soap::class, $this->clientArguments);

            case HttpClient::GUZZLE:
                return $this->objectManager->create(Guzzle::class, $this->clientArguments);
        }

        throw new ClientException(new Phrase('Http Client "%1" is invalid.', [$httpClientCode]));
    }
}
