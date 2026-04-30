<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Request;

use ByteBencher\Gateway\Api\Config\ConfigInterface;
use ByteBencher\Gateway\Api\Request\BuilderInterface;

abstract class AbstractDataBuilder implements BuilderInterface
{
    /**
     * List of available parameters of the Entity to Update
     * @var array
     */
    protected array $availableParamsToUpdate = [];

    protected ConfigInterface $config;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(
        ConfigInterface $config
    ) {
        $this->config = $config;
    }

    /**
     * Filters dataset and Returns list of available only parameters
     *
     * @param array $dataset
     *
     * @return array
     */
    protected function filterParameters(array $dataset = []): array
    {
        $filteredList = [];
        foreach ($dataset as $key => $value) {
            if (in_array($key, $this->availableParamsToUpdate)) {
                $filteredList[$key] = $value;
            }
        }

        return $filteredList;
    }
}
