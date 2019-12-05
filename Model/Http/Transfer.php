<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http;

use SR\Gateway\Api\Http\TransferInterface;

class Transfer implements TransferInterface
{
    /**
     * Name of Auth username field
     */
    const AUTH_USERNAME = 'username';

    /**
     * Name of Auth password field
     */
    const AUTH_PASSWORD = 'password';

    /**
     * @var array
     */
    protected $clientConfig;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array|string
     */
    protected $body;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var bool
     */
    protected $encode;

    /**
     * @var array
     */
    protected $auth;

    /**
     * Transfer constructor.
     * @param array $clientConfig
     * @param array $headers
     * @param $body
     * @param array $auth
     * @param $method
     * @param $uri
     * @param $encode
     */
    public function __construct(array $clientConfig, array $headers, $body, array $auth, $method, $uri, $encode)
    {
        $this->clientConfig = $clientConfig;
        $this->headers = $headers;
        $this->body = $body;
        $this->auth = $auth;
        $this->method = $method;
        $this->uri = $uri;
        $this->encode = $encode;
    }

    /**
     * @inheritDoc
     */
    public function getClientConfig()
    {
        return $this->clientConfig;
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return (string)$this->method;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return (string)$this->uri;
    }

    /**
     * @inheritDoc
     */
    public function shouldEncode()
    {
        return $this->encode;
    }

    /**
     * @inheritDoc
     */
    public function getAuthUsername()
    {
        return $this->auth[self::AUTH_USERNAME];
    }

    /**
     * @inheritDoc
     */
    public function getAuthPassword()
    {
        return $this->auth[self::AUTH_PASSWORD];
    }
}
