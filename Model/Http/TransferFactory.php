<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http;

use SR\Gateway\Model\Request\AbstractClientBuilder;
use SR\Gateway\Model\Request\ApiCredentialsBuilder;

class TransferFactory extends AbstractTransferFactory
{
    /**
     * STORE ID parameter value to get Specific Config Parameters etc
     *
     * @var mixed|null
     */
    protected $storeId;

    /**
     * @inheritDoc
     */
    protected function prepareTransferBuilder(array $request = [])
    {
        $this->fetchStoreId($request);

        $this->addClientConfig($request);
        $this->addApiCredentials($request);
        $this->addTransferUri($request);
        $this->addTransferMethod($request);
        $this->addClientHeaders($request);

        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function cleanRequestSubject(array &$request = [])
    {
        unset(
            $request[AbstractClientBuilder::KEY_API_CREDENTIALS],
            $request[AbstractClientBuilder::KEY_API_ENDPOINT],
            $request[AbstractClientBuilder::KEY_CLIENT_CONFIG],
            $request[AbstractClientBuilder::KEY_CLIENT_HEADERS],
            $request[AbstractClientBuilder::KEY_REQUEST_ACTION],
            $request[AbstractClientBuilder::KEY_REQUEST_METHOD],
            $request[AbstractClientBuilder::KEY_STORE_ID]
        );

        return $this;
    }

    /**
     * Search the Store ID parameter in the Request Subject
     * Defines it as a property of the Class.
     *
     * @param array $request
     * @return $this
     */
    protected function fetchStoreId(array &$request)
    {
        if (isset($request[AbstractClientBuilder::KEY_STORE_ID])) {
            $this->storeId = $request[AbstractClientBuilder::KEY_STORE_ID];
        }

        return $this;
    }

    /**
     * Sets Transfer's Client Config
     *
     * @param array $request
     * @return $this
     */
    protected function addClientConfig($request)
    {
        if (isset($request[AbstractClientBuilder::KEY_CLIENT_CONFIG])) {
            $this->transferBuilder->setClientConfig($request[AbstractClientBuilder::KEY_CLIENT_CONFIG]);
        }

        return $this;
    }

    /**
     * Sets Transfer's Api Credentials (aka Api Username and Api Password)
     *
     * @param array $request
     * @return $this
     */
    protected function addApiCredentials($request)
    {
        if (isset($request[ApiCredentialsBuilder::KEY_API_CREDENTIALS])) {
            $this->transferBuilder->setAuthUsername($request[ApiCredentialsBuilder::KEY_API_CREDENTIALS][ApiCredentialsBuilder::API_USERNAME] ?? null);
            $this->transferBuilder->setAuthPassword($request[ApiCredentialsBuilder::KEY_API_CREDENTIALS][ApiCredentialsBuilder::API_PASSWORD] ?? null);
        }

        return $this;
    }

    /**
     * Sets Transfer's method (aka Http Client Request Method)
     *
     * @param array $request
     * @return $this
     */
    protected function addTransferMethod($request)
    {
        if (isset($request[AbstractClientBuilder::KEY_REQUEST_METHOD])) {
            $this->transferBuilder->setMethod($request[AbstractClientBuilder::KEY_REQUEST_METHOD]);
        }

        return $this;
    }

    /**
     * Sets Transfer's uri (aka Api Endpoint)
     *
     * @param array $request
     * @return $this
     */
    protected function addTransferUri($request)
    {
        if (isset($request[AbstractClientBuilder::KEY_API_ENDPOINT])) {
            $this->transferBuilder->setUri($request[AbstractClientBuilder::KEY_API_ENDPOINT]);
        }

        return $this;
    }

    /**
     * Sets Transfer's Headers (are used by HttpClient)
     *
     * @param array $request
     * @return $this
     */
    protected function addClientHeaders($request)
    {
        if (isset($request[AbstractClientBuilder::KEY_CLIENT_HEADERS])) {
            $this->transferBuilder->setHeaders($request[AbstractClientBuilder::KEY_CLIENT_HEADERS]);
        }

        return $this;
    }
}
