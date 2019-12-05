<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Logger\Handler;

use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Debug as LoggerDebugHandler;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Model\Config\Config;

class FileHandler extends LoggerDebugHandler
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/' . Config::EXT_ALIAS . '.log';

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * FileHandler constructor.
     * @param DriverInterface $filesystem
     * @param ConfigInterface $config
     * @param null $filePath
     * @param null $fileName
     * @throws \Exception
     */
    public function __construct(
        DriverInterface $filesystem,
        ConfigInterface $config,
        $filePath = null,
        $fileName = null
    ) {
        $this->config = $config;

        parent::__construct($filesystem, $filePath, $fileName);
    }

    /**
     * @inheritDoc
     */
    public function isHandling(array $record)
    {
        // NOTE: check the Module is active
        if (!$this->config->getValue(Config::KEY_CONFIG_ACTIVE, Config::GROUP_PATH_GENERAL)) {
            return false;
        }

        // NOTE: check if Level is applicable (default condition)
        if (!parent::isHandling($record)) {
            return false;
        }

        // NOTE: check if Debug functionality is active
        return (bool)$this->config->getValue(Config::KEY_CONFIG_DEBUG, Config::GROUP_PATH_GENERAL);
    }
}
