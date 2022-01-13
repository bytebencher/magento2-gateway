<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\Http\Client;

use SR\Gateway\Api\Http\TransferInterface;
use SR\Gateway\Exception\ClientException;

/**
 * Interface ClientInterface
 * @package SR\Gateway\Api\Http\Client
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
