<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Request;

class ApiEndpointBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        $storeId = $buildSubject['subject']['store_id'] ?? null;

        return [
            self::KEY_API_ENDPOINT => $this->config->getApiEndpoint($storeId),
        ];
    }
}
