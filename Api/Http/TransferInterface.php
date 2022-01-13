<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Api\Http;

/**
 * Interface TransferInterface
 * @package SR\Gateway\Api\Http
 */
interface TransferInterface
{
    /**
     * Returns gateway client configuration
     *
     * @return array
     */
    public function getClientConfig(): array;

    /**
     * Returns method used to place request
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * Returns headers
     *
     * @return array
     */
    public function getHeaders(): array;

    /**
     * Whether body should be encoded before place
     *
     * @return bool
     */
    public function shouldEncode(): bool;

    /**
     * Returns request body
     *
     * @return array|string
     */
    public function getBody();

    /**
     * Returns URI
     *
     * @return string
     */
    public function getUri(): string;

    /**
     * Returns Auth username
     *
     * @return string
     */
    public function getAuthUsername(): string;

    /**
     * Returns Auth password
     *
     * @return string
     */
    public function getAuthPassword(): string;
}
