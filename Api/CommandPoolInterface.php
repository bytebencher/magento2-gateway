<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api;

use Magento\Framework\Exception\NotFoundException;

/**
 * Interface CommandPoolInterface
 * @package SR\Gateway\Api
 */
interface CommandPoolInterface
{
    /**
     * Retrieves operation
     *
     * @param string $commandCode
     *
     * @return CommandInterface
     *
     * @throws NotFoundException
     */
    public function get(string $commandCode): CommandInterface;
}
