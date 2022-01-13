<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\Http\Client;

use SR\Gateway\Exception\ClientException;

/**
 * Interface ClientFactoryInterface
 * @package SR\Gateway\Api\Http\Client
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
