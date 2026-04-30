<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Http\Client;

use ByteBencher\Gateway\Api\Http\TransferInterface;
use ByteBencher\Gateway\Exception\ClientException;

/**
 * Interface ClientInterface
 * @package ByteBencher\Gateway\Api\Http\Client
 */
interface ClientInterface
{
    /**
     * Places request to gateway. Returns result as ENV array
     *
     * @param TransferInterface $transferObject
     *
     * @return array
     *
     * @throws ClientException
     */
    public function placeRequest(TransferInterface $transferObject): array;
}
