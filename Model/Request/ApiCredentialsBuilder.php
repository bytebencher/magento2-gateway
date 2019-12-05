<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class ApiCredentialsBuilder extends AbstractClientBuilder
{
    const API_USERNAME = 'api_username';
    const API_PASSWORD = 'api_password';

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        $storeId = $buildSubject['subject']['store_id'] ?? null;

        return [
            self::KEY_API_CREDENTIALS => [
                self::API_USERNAME => $this->config->getApiUsername($storeId),
                self::API_PASSWORD => $this->config->getApiPassword($storeId),
            ],
        ];
    }
}
