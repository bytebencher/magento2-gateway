<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Model\System\Config\Source\Mode as ApiMode;

class Config implements ConfigInterface
{
    public const EXT_ALIAS = 'srgateway';

    /**
     * Is used to init $this->pathPattern
     *
     * @var string
     */
    public const DEFAULT_PATH_PATTERN = self::EXT_ALIAS . '/%s/%s';

    public const GROUP_PATH_CRON = 'cron';
    public const GROUP_PATH_CUSTOMER = 'customer';
    public const GROUP_PATH_EMAIL = 'email';
    public const GROUP_PATH_GATEWAY = 'gateway';
    public const GROUP_PATH_GENERAL = 'general';
    public const GROUP_PATH_LOG = 'log';
    public const GROUP_PATH_ORDER = 'order';
    public const GROUP_PATH_PRODUCT = 'product';

    /**
     * Is used to init $this->pathGroup
     *
     * @var string
     */
    public const DEFAULT_PATH_GROUP = self::GROUP_PATH_GENERAL;

    /**#@+
     * XML Config parts
     * ex: '{self::EXT_ALIAS}/{self::GROUP_PATH_...}/{KEY_CONFIG_...}'
     */
    public const KEY_CONFIG_ACTIVE = 'active';
    public const KEY_CONFIG_API_ENDPOINT_PRODUCTION = 'api_endpoint_production';
    public const KEY_CONFIG_API_ENDPOINT_SANDBOX = 'api_endpoint_sandbox';
    public const KEY_CONFIG_API_PASSWORD_PRODUCTION = 'api_password_production';
    public const KEY_CONFIG_API_PASSWORD_SANDBOX = 'api_password_sandbox';
    public const KEY_CONFIG_API_USERNAME_PRODUCTION = 'api_username_production';
    public const KEY_CONFIG_API_USERNAME_SANDBOX = 'api_username_sandbox';
    public const KEY_CONFIG_DEBUG = 'debug';
    public const KEY_CONFIG_HTTP_CLIENT = 'http_client';
    public const KEY_CONFIG_MODE = 'mode';

    /**#@- */

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var string
     */
    protected $pathPattern;

    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param string $pathPattern
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        $pathPattern = self::DEFAULT_PATH_PATTERN
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->pathPattern = $pathPattern;
    }

    /**
     * @inheritDoc
     */
    public function getValue($field, $group = null, $storeId = null)
    {
        if ($this->pathPattern === null) {
            return null;
        }

        return $this->scopeConfig->getValue(
            sprintf($this->pathPattern, $group ?: static::DEFAULT_PATH_GROUP, $field),
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function setPathPattern($pathPattern)
    {
        $this->pathPattern = $pathPattern;
    }

    /**
     * @inheritDoc
     */
    public function getActive($storeId = null)
    {
        return $this->getValue(static::KEY_CONFIG_ACTIVE, static::DEFAULT_PATH_GROUP, $storeId);
    }

    /**
     * @inheritDoc
     */
    public function getApiUsername($storeId = null)
    {
        return $this->getValue(
            $this->isModeProduction($storeId) ? static::KEY_CONFIG_API_USERNAME_PRODUCTION : static::KEY_CONFIG_API_USERNAME_SANDBOX,
            static::DEFAULT_PATH_GROUP,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function getApiPassword($storeId = null)
    {
        return $this->getValue(
            $this->isModeProduction($storeId) ? static::KEY_CONFIG_API_PASSWORD_PRODUCTION : static::KEY_CONFIG_API_PASSWORD_SANDBOX,
            static::DEFAULT_PATH_GROUP,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function getApiEndpoint($storeId = null)
    {
        return $this->getValue(
            $this->isModeProduction($storeId) ? static::KEY_CONFIG_API_ENDPOINT_PRODUCTION : static::KEY_CONFIG_API_ENDPOINT_SANDBOX,
            static::DEFAULT_PATH_GROUP,
            $storeId
        );
    }

    /**
     * @inheritDoc
     */
    public function isModeProduction($storeId = null)
    {
        return (int)$this->getValue(self::KEY_CONFIG_MODE, static::DEFAULT_PATH_GROUP, $storeId) === ApiMode::PRODUCTION;
    }
}
