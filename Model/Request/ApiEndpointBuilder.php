<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class ApiEndpointBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        $storeId = $buildSubject['subject']['store_id'] ?? null;

        return [
            self::KEY_API_ENDPOINT => $this->config->getApiEndpoint($storeId),
        ];
    }
}
