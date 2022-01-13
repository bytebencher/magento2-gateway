<?php
/**
 * Copyright © 2020 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http;

use Laminas\Http\Request as HttpRequest;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Http\TransferFactoryInterface;
use SR\Gateway\Api\Http\TransferInterface;
use SR\Gateway\Exception\TransferBuilderException;
use SR\Gateway\Model\Request\AbstractClientBuilder;

abstract class AbstractTransferFactory implements TransferFactoryInterface
{
    protected TransferBuilder $transferBuilder;
    protected ConfigInterface $config;

    /**
     * @param TransferBuilder $transferBuilder
     * @param ConfigInterface $config
     */
    public function __construct(
        TransferBuilder $transferBuilder,
        ConfigInterface $config
    ) {
        $this->transferBuilder = $transferBuilder;
        $this->config = $config;
    }

    /**
     * Prepares needed Properties of TransferBuilder
     *
     * @param array $request
     *
     * @return $this
     *
     * @throws TransferBuilderException
     */
    abstract protected function prepareTransferBuilder(array $request = []): self;

    /**
     * Clean unnecessary data/params from the Request
     *
     * @param array $request
     *
     * @return $this
     */
    abstract protected function cleanRequestSubject(array &$request = []): self;

    /**
     * @inheritDoc
     */
    public function create(array $request): TransferInterface
    {
        $this->prepareTransferBuilder($request);

        $httpRequestMethod = $request[AbstractClientBuilder::KEY_REQUEST_METHOD];

        $this->cleanRequestSubject($request);

        // NOTE: POST, PATCH can send BODY, but GET, DELETE - can't
        if (in_array($httpRequestMethod, [HttpRequest::METHOD_POST, HttpRequest::METHOD_PUT, HttpRequest::METHOD_PATCH], true)) {
            // NOTE: body SHOULD contain list of needed parameters ONLY (it means all redundant, temp etc. MUST be removed)
            $this->transferBuilder->setBody($request);

            // TODO: implement logic for it (tmp it's HARD-CODED)
            $this->transferBuilder->shouldEncode(true);
        }

        return $this->transferBuilder->build();
    }
}
