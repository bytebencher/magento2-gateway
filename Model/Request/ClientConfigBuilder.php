<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request;

class ClientConfigBuilder extends AbstractClientBuilder
{
    /**#@+
     * the Section Parameters
     */
    public const PARAM_HTTP_ADAPTER_OPTIONS = 'http_adapter_options';
    /**#@- */

    /**#@+
     * for SOAP/REST requests
     */
    public const PARAM_WSDL = 'wsdl';
    public const PARAM_SOAP_HEADERS = 'soap_headers';
    public const PARAM_SOAP_FUNCTION_NAME = 'soap_function_name';

    public const PARAM_CURL_EXTRA_OPTIONS = 'curl_extra_options';
    /**#@- */

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        return [
            self::KEY_CLIENT_CONFIG => [

            ],
        ];
    }

    /**
     * Fetches user-defined extra http adapter options;
     *
     * @param array $buildSubject
     *
     * @return array
     */
    protected function fetchUserDefinedOptions(array $buildSubject): array
    {
        $options = $buildSubject[self::PARAM_HTTP_ADAPTER_OPTIONS] ?? [];

        if (empty($options)) {
            return [];
        }

        return !is_array($options) ? [$options] : $options;
    }
}
