<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\Request;

use SR\Gateway\Api\CommandInterface;

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
