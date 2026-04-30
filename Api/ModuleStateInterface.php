<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api;

/**
 * Interface ModuleStateInterface
 * @package ByteBencher\Gateway\Api
 */
interface ModuleStateInterface
{
    /**
     * Determine whether the Module is active.
     *
     * @param mixed|null $store
     * @return bool
     */
    public function isActive($store = null): bool;
}
