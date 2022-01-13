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
    public const AUTH_USERNAME = 'username';

    /**
     * Name of Auth password field
     */
    public const AUTH_PASSWORD = 'password';

    protected array $clientConfig;
    protected array $headers;
    protected string $method;

    /**
     * @var array|string
     */
    protected $body;
    protected string $uri;
    protected bool $encode;
    protected array $auth;

    /**
     * @param array $clientConfig
     * @param array $headers
     * @param mixed $body
     * @param array $auth
     * @param string $method
     * @param string $uri
     * @param bool $encode
     */
    public function __construct(array $clientConfig, array $headers, $body, array $auth, string $method, string $uri, bool $encode)
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
    public function getClientConfig(): array
    {
        return $this->clientConfig;
    }

    /**
     * @inheritDoc
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
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
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @inheritDoc
     */
    public function shouldEncode(): bool
    {
        return $this->encode;
    }

    /**
     * @inheritDoc
     */
    public function getAuthUsername(): string
    {
        return $this->auth[self::AUTH_USERNAME];
    }

    /**
     * @inheritDoc
     */
    public function getAuthPassword(): string
    {
        return $this->auth[self::AUTH_PASSWORD];
    }
}
