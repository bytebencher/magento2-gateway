<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http;

use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Http\TransferFactoryInterface;
use SR\Gateway\Exception\TransferBuilderException;

abstract class AbstractTransferFactory implements TransferFactoryInterface
{
    /**
     * @var TransferBuilder
     */
    protected $transferBuilder;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * TransferFactory constructor.
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
     * @return $this;
     * @throws TransferBuilderException
     */
    abstract protected function prepareTransferBuilder(array $request = []);

    /**
     * Clean unnecessary data/params from the Request
     *
     * @param array $request
     * @return $this;
     */
    abstract protected function cleanRequestSubject(array &$request = []);

    /**
     * @inheritDoc
     */
    public function create(array $request)
    {
        $this->prepareTransferBuilder($request);
        $this->cleanRequestSubject($request);

        // NOTE: body SHOULD contain list of needed parameters ONLY (it means all redundant, temp etc. MUST be removed)
        $this->transferBuilder->setBody($request);

        return $this->transferBuilder->build();
    }
}
