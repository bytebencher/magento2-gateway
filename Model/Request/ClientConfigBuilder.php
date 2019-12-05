<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class ClientConfigBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        return [
            self::KEY_CLIENT_CONFIG => [

            ],
        ];
    }
}
