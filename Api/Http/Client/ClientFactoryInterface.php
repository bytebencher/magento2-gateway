<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Http\Client;

use ByteBencher\Gateway\Exception\ClientException;

/**
 * Interface ClientFactoryInterface
 * @package ByteBencher\Gateway\Api\Http\Client
 */
interface ClientFactoryInterface
{
    /**
     * Builds gateway transfer object
     *
     * @param array $subject
     * @param array $arguments [optional] list of parameters which are assumed by creating Object
     *
     * @return ClientInterface
     *
     * @throws ClientException
     */
    public function create(array $subject, array $arguments = []): ClientInterface;
}
