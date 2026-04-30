<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api;

use Magento\Framework\Exception\NotFoundException;

/**
 * Interface CommandPoolInterface
 * @package ByteBencher\Gateway\Api
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
