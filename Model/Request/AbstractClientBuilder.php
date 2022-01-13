<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Request\BuilderInterface;

abstract class AbstractClientBuilder implements BuilderInterface
{
    /**
     * Http Client: API credentials (User and Password)
     */
    public const KEY_API_CREDENTIALS = 'api_credentials';

    /**
     * Http Client: API endpoint uri
     */
    public const KEY_API_ENDPOINT = 'api_endpoint';

    /**
     * Http Client: client config
     */
    public const KEY_CLIENT_CONFIG = 'client_config';

    /**
     * Http Client: client headers
     */
    public const KEY_CLIENT_HEADERS = 'client_headers';

    /**
     * Http Client: request action (ex: Order, UpdateExpiry etc)
     * API Endpoint url action-suffix (in REST) or SoapAction (in SOAP)
     */
    public const KEY_REQUEST_ACTION = 'request_action';

    /**
     * Http Client: request method
     */
    public const KEY_REQUEST_METHOD = 'request_method';

    /**
     * Http Client: Store View ID
     */
    public const KEY_STORE_ID = 'store_id';

    protected ConfigInterface $config;

    /**
     * @param ConfigInterface $config
     */
    public function __construct(
        ConfigInterface $config
    ) {
        $this->config = $config;
    }
}
