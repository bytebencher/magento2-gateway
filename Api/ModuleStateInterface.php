<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api;

/**
 * Interface ModuleStateInterface
 * @package SR\Gateway\Api
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
