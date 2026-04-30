<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Http;

use ByteBencher\Gateway\Exception\TransferBuilderException;

/**
 * Interface TransferFactoryInterface
 * @package ByteBencher\Gateway\Api\Http
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
