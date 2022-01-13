<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class ApiCredentialsBuilder extends AbstractClientBuilder
{
    public const API_USERNAME = 'api_username';
    public const API_PASSWORD = 'api_password';

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
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
