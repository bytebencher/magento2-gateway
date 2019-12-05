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
     * ClientFactory constructor.
     * @param ObjectManagerInterface $objectManager
     * @param ConfigInterface $config
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        ConfigInterface $config
    ) {
        $this->objectManager = $objectManager;
        $this->config = $config;
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
                // TODO: use Create instead of Get if it is needed
                // TODO: CURRENTLY IT IS IN TEST/DEBUG MODE
                //return $this->objectManager->create(Rest::class, $arguments);
                return $this->objectManager->get(Rest::class);

            case HttpClient::SOAP:
                // TODO: use Create instead of Get if it is needed
                // TODO: CURRENTLY IT IS IN TEST/DEBUG MODE
                //return $this->objectManager->create(Soap::class, $arguments);
                return $this->objectManager->get(Soap::class);
        }

        throw new ClientException(new Phrase('Http Client "%1" is invalid.', [$httpClientCode]));
    }
}
