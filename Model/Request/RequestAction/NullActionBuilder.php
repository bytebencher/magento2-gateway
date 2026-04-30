<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Request\RequestAction;

use ByteBencher\Gateway\Model\Request\AbstractClientBuilder;

class NullActionBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        /**
         * @see: \ByteBencher\Gateway\Model\Request\AbstractClientBuilder::KEY_REQUEST_ACTION
         */
        return [];
    }
}
