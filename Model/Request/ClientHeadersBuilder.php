<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Request;

class ClientHeadersBuilder extends AbstractClientBuilder
{
    /**#@+
     * the Section Parameters
     */
    public const PARAM_HTTP_HEADERS = 'http_headers';
    /**#@- */

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        return [
            self::KEY_CLIENT_HEADERS => array_replace_recursive(
                $this->getDefaults(),
                $this->fetchUserDefinedHeaders($buildSubject)
            ),
        ];
    }

    /**
     * Returns Default set of HTTP Headers
     * NOTE: please the method, override to customize the dataset
     *
     * @return string[]
     */
    protected function getDefaults(): array
    {
        // NOTE: headers below are specified for REST http-client
        //     CURLOPT_HTTPHEADER is used
        //     @url https://www.php.net/manual/en/function.curl-setopt.php
        //     An array of HTTP header fields to set, in the format.
        //     ex: ['Content-type: text/plain', 'Content-length: 100']

        return [
            'Accept' => 'application/json',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Content-Type' => 'application/json;charset=utf-8',
        ];
    }

    /**
     * Fetches user-defined extra http headers;
     * NOTE: please the method, override to customize the dataset
     *
     * @param array $buildSubject
     *
     * @return array
     */
    protected function fetchUserDefinedHeaders(array $buildSubject): array
    {
        $headers = $buildSubject[self::PARAM_HTTP_HEADERS] ?? [];

        if (empty($headers) || !is_array($headers)) {
            return [];
        }

        return $headers;
    }
}
