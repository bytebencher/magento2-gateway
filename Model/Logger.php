<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model;

use Psr\Log\LoggerInterface as PsrLoggerInterface;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\LoggerInterface;
use SR\Gateway\Model\Config\Config;
use SR\Gateway\Model\Logger\Handler\DbHandler;

class Logger implements LoggerInterface
{
    const DEBUG_KEYS_MASK = '****';

    /**
     * @var PsrLoggerInterface
     */
    protected $logger;

    /**
     * @var ConfigInterface|null
     */
    protected $config;

    /**
     * Logger constructor.
     * @param PsrLoggerInterface $logger
     * @param ConfigInterface|null $config
     */
    public function __construct(
        PsrLoggerInterface $logger,
        ConfigInterface $config = null
    ) {
        $this->logger = $logger;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function debug($data, array $maskKeys = null, $forceDebug = null)
    {
        $debugOn = $forceDebug !== null ? $forceDebug : $this->isDebugOn();
        $isUsedForDbLog = (bool)(is_array($data) ? ($data[DbHandler::DB_LOG_HANDLER_FLAG] ?? null) : null);

        if ($debugOn === false && $isUsedForDbLog === false) {
            return false;
        }

        $message = $data;
        $context = [];

        if (is_array($data)) {
            // NOTE: not every Log dataset should be Stored into DB-Table
            if ($isUsedForDbLog) {
                $message = $data['message'] ?? 'The Log data has been stored into Database.';
                $context = $data;
            } else {
                $maskKeys = $maskKeys !== null ? $maskKeys : $this->getDebugReplaceFields();
                $data = $this->filterDebugData($data, $maskKeys);
                $message = var_export($data, true);
            }
        }

        // NOTE: remove redundant key from Log Context
        unset($context['message']);

        return $this->logger->debug($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = [])
    {
        return $this->logger->critical($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = [])
    {
        return $this->logger->info($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = [])
    {
        return $this->logger->error($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = [])
    {
        return $this->logger->warning($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = [])
    {
        return $this->logger->notice($message, $context);
    }

    /**
     * Whether debug is enabled in configuration
     *
     * @return bool
     */
    private function isDebugOn()
    {
        return $this->config && (bool)$this->config->getValue(Config::KEY_CONFIG_DEBUG);
    }

    /**
     * Returns configured keys to be replaced with mask
     *
     * @return array
     */
    private function getDebugReplaceFields()
    {
        if ($this->config && $this->config->getValue('debugReplaceKeys')) {
            return explode(',', $this->config->getValue('debugReplaceKeys'));
        }
        return [];
    }

    /**
     * Recursive filter data by private conventions
     *
     * @param array $debugData
     * @param array $debugReplacePrivateDataKeys
     * @return array
     */
    protected function filterDebugData(array $debugData, array $debugReplacePrivateDataKeys)
    {
        $debugReplacePrivateDataKeys = array_map('strtolower', $debugReplacePrivateDataKeys);

        foreach (array_keys($debugData) as $key) {
            if (in_array(strtolower($key), $debugReplacePrivateDataKeys)) {
                $debugData[$key] = self::DEBUG_KEYS_MASK;
            } elseif (is_array($debugData[$key])) {
                $debugData[$key] = $this->filterDebugData($debugData[$key], $debugReplacePrivateDataKeys);
            }
        }
        return $debugData;
    }
}
