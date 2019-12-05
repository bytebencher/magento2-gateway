<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\Config;

/**
 * Interface ConfigInterface
 * @package SR\Gateway\Api\Config
 */
interface ConfigInterface
{
    /**
     * Retrieves information from configuration
     *
     * @param string $field
     * @param string|null $group
     * @param int|null $storeId
     * @return mixed
     */
    public function getValue($field, $group = null, $storeId = null);

    /**
     * Sets path pattern
     *
     * @param string $pathPattern
     * @return void
     */
    public function setPathPattern($pathPattern);

    /**
     * Returns value of "Enable" parameter
     *
     * @param mixed|null $storeId
     * @return string|null
     */
    public function getActive($storeId = null);

    /**
     * Returns API username
     *
     * @param mixed|null $storeId
     * @return string|null
     */
    public function getApiUsername($storeId = null);

    /**
     * Returns API password
     *
     * @param mixed|null $storeId
     * @return string|null
     */
    public function getApiPassword($storeId = null);

    /**
     * Returns API Endpoint url
     *
     * @param mixed|null $storeId
     * @return string|null
     */
    public function getApiEndpoint($storeId = null);
}
