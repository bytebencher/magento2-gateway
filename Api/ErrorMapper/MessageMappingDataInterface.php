<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\ErrorMapper;

/**
 * Interface MessageMappingDataInterface
 *
 * @package SR\Gateway\Api\ErrorMapper
 */
interface MessageMappingDataInterface
{
    /**
     * Merge Message data to the object
     *
     * @param array $mappings List of Mappings for Messages Ex: ['{code}' => '{mapped-message}']
     *
     * @return void
     */
    public function merge(array $mappings): void;

    /**
     * Get Message value by key
     *
     * @param string $key     Message Code
     * @param mixed  $default Default Message in case Message-by-Code doesn't exist
     *
     * @return mixed
     */
    public function get($key, $default = null);
}
