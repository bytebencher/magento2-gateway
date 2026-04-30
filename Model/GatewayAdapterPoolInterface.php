<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model;

interface GatewayAdapterPoolInterface
{
    /**
     * @param string[] $classNames
     */
    public function merge(array $classNames): void;

    /**
     * Get GatewayAdapter class-name by given key
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);
}
