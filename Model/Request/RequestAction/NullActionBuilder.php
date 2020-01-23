<?php
/**
 * Copyright © 2020 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request\RequestAction;

use SR\Gateway\Model\Request\AbstractClientBuilder;

class NullActionBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        /**
         * @see: \SR\Gateway\Model\Request\AbstractClientBuilder::KEY_REQUEST_ACTION
         */
        return [];
    }
}
