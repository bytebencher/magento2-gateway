<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class ClientHeadersBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        return [
            self::KEY_CLIENT_HEADERS => [
                // NOTE: headers below are specified for REST http-client
                'Content-Type: application/json;charset=utf-8',
                'Accept: application/json',
            ],
        ];
    }
}
