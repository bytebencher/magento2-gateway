<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http;

use SR\Gateway\Api\Http\TransferInterface;

class TransferBuilder
{
    protected array $clientConfig = [];
    protected array $headers = [];
    protected string $method = '';

    /**
     * @var array|string
     */
    protected $body = [];
    protected string $uri = '';
    protected bool $encode = false;
    protected array $auth = [
        Transfer::AUTH_USERNAME => null,
        Transfer::AUTH_PASSWORD => null,
    ];

    /**
     * @param array $clientConfig
     *
     * @return $this
     */
    public function setClientConfig(array $clientConfig): self
    {
        $this->clientConfig = $clientConfig;
        return $this;
    }

    /**
     * @param array $headers
     *
     * @return $this
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param array|string $body
     *
     * @return $this
     */
    public function setBody($body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param string|null $username
     * @return $this
     */
    public function setAuthUsername(?string $username): self
    {
        $this->auth[Transfer::AUTH_USERNAME] = $username;
        return $this;
    }

    /**
     * @param string|null $password
     *
     * @return $this
     */
    public function setAuthPassword(?string $password): self
    {
        $this->auth[Transfer::AUTH_PASSWORD] = $password;
        return $this;
    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @param string $uri
     *
     * @return $this
     */
    public function setUri(string $uri): self
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @param bool $encode
     *
     * @return $this
     */
    public function shouldEncode(bool $encode): self
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
