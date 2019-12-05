<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class StoreBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        return [
            self::KEY_STORE_ID => $buildSubject['subject']['store_id'] ?? null,
        ];
    }
}
