<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class ClientConfigBuilder extends AbstractClientBuilder
{
    /**#@+
     * for SOAP requests
     */
    public const PARAM_WSDL = 'wsdl';
    public const PARAM_SOAP_HEADERS = 'soap_headers';
    public const PARAM_SOAP_FUNCTION_NAME = 'soap_function_name';
    /**#@- */

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        return [
            self::KEY_CLIENT_CONFIG => [

            ],
        ];
    }
}
