<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http\Client;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Phrase;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Http\Client\ClientFactoryInterface;
use SR\Gateway\Exception\ClientException;
use SR\Gateway\Model\Config\Config;
use SR\Gateway\Model\System\Config\Source\HttpClient;

class ClientFactory implements ClientFactoryInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * List of possible arguments which are passed into Client Adapter Object (on create instance)
     *
     * @var array
     */
    protected $clientArguments = [];

    /**
     * ClientFactory constructor.
     * @param ObjectManagerInterface $objectManager
     * @param ConfigInterface $config
     * @param array $clientArguments
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        ConfigInterface $config,
        array $clientArguments = []
    ) {
        $this->objectManager = $objectManager;
        $this->config = $config;
        $this->clientArguments = $clientArguments;
    }

    /**
     * @inheritDoc
     */
    public function create(array $subject, array $arguments = [])
    {
        $storeId = $subject['store_id'] ?? null;
        $httpClientCode = $this->config->getValue(Config::KEY_CONFIG_HTTP_CLIENT, Config::DEFAULT_PATH_GROUP, $storeId) ?: null;

        switch ($httpClientCode) {
            case HttpClient::REST:
                return $this->objectManager->create(Rest::class, $this->clientArguments);

            case HttpClient::SOAP:
                return $this->objectManager->create(Soap::class, $this->clientArguments);
        }

        throw new ClientException(new Phrase('Http Client "%1" is invalid.', [$httpClientCode]));
    }
}
