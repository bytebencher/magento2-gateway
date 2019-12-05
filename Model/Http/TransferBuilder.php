<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http;

use SR\Gateway\Api\Http\TransferInterface;

class TransferBuilder
{
    /**
     * @var array
     */
    protected $clientConfig = [];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array|string
     */
    protected $body = [];

    /**
     * @var string
     */
    protected $uri = '';

    /**
     * @var bool
     */
    protected $encode = false;

    /**
     * @var array
     */
    protected $auth = [Transfer::AUTH_USERNAME => null, Transfer::AUTH_PASSWORD => null];

    /**
     * @param array $clientConfig
     * @return $this
     */
    public function setClientConfig(array $clientConfig)
    {
        $this->clientConfig = $clientConfig;

        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param array|string $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setAuthUsername($username)
    {
        $this->auth[Transfer::AUTH_USERNAME] = $username;

        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setAuthPassword($password)
    {
        $this->auth[Transfer::AUTH_PASSWORD] = $password;

        return $this;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param string $uri
     * @return $this
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @param bool $encode
     * @return $this
     */
    public function shouldEncode($encode)
    {
        $this->encode = $encode;

        return $this;
    }

    /**
     * @return TransferInterface
     */
    public function build()
    {
        return new Transfer(
            $this->clientConfig,
            $this->headers,
            $this->body,
            $this->auth,
            $this->method,
            $this->uri,
            $this->encode
        );
    }
}
