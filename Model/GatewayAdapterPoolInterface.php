<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model;

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
