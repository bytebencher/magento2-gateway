<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Request;

use ByteBencher\Gateway\Api\CommandInterface;

class StoreBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        return [
            self::KEY_STORE_ID => $buildSubject[CommandInterface::ARGUMENT_SUBJECT]['store_id'] ?? null,
        ];
    }
}
