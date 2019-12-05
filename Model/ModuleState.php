<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model;

use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\ModuleStateInterface;

class ModuleState implements ModuleStateInterface
{
    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var bool
     */
    private $forceActive;

    /**
     * ModuleState constructor.
     * @param ConfigInterface $config
     * @param bool|null $forceActive
     */
    public function __construct(ConfigInterface $config, $forceActive = null)
    {
        $this->config = $config;
        $this->forceActive = $forceActive;
    }

    /**
     * @inheritDoc
     */
    public function isActive($store = null)
    {
        if (!is_null($this->forceActive)) {
            return (bool)$this->forceActive;
        }

        return (bool)$this->config->getActive($store);
    }
}
