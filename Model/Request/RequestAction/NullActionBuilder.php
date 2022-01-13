<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\Request\RequestAction;

use SR\Gateway\Model\Request\AbstractClientBuilder;

class NullActionBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        /**
         * @see: \SR\Gateway\Model\Request\AbstractClientBuilder::KEY_REQUEST_ACTION
         */
        return [];
    }
}
