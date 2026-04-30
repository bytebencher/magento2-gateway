<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Config;

/**
 * Interface ConfigInterface
 * @package ByteBencher\Gateway\Api\Config
 */
interface ConfigInterface
{
    /**
     * Retrieves information from configuration
     *
     * @param string $field
     * @param string|null $group
     * @param mixed|null $storeId
     *
     * @return mixed
     */
    public function getValue(string $field, ?string $group = null, $storeId = null);

    /**
     * Sets path pattern
     *
     * @param string $pathPattern
     *
     * @return void
     */
    public function setPathPattern(string $pathPattern): void;

    /**
     * Returns value of "Enable" parameter
     *
     * @param mixed|null $storeId
     *
     * @return string|null
     */
    public function getActive($storeId = null): ?string;

    /**
     * Returns API username
     *
     * @param mixed|null $storeId
     *
     * @return string|null
     */
    public function getApiUsername($storeId = null): ?string;

    /**
     * Returns API password
     *
     * @param mixed|null $storeId
     *
     * @return string|null
     */
    public function getApiPassword($storeId = null): ?string;

    /**
     * Returns API Endpoint url
     *
     * @param mixed|null $storeId
     *
     * @return string|null
     */
    public function getApiEndpoint($storeId = null): ?string;
}
