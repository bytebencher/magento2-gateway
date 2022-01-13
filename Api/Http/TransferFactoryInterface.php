<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\Http;

use SR\Gateway\Exception\TransferBuilderException;

/**
 * Interface TransferFactoryInterface
 * @package SR\Gateway\Api\Http
 */
interface TransferFactoryInterface
{
    /**
     * Builds gateway transfer object
     *
     * @param array $request
     *
     * @return TransferInterface
     *
     * @throws TransferBuilderException
     */
    public function create(array $request): TransferInterface;
}
