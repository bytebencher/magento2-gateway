<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

declare(strict_types=1);

namespace SR\Gateway\Model;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\Phrase;
use SR\Gateway\Exception\LocalizedException;

class GatewayAdapterFactory implements GatewayAdapterFactoryInterface
{
    private ObjectManagerInterface $objectManager;
    private GatewayAdapterPoolInterface $gatewayAdapterPool;
    private array $clientArguments;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param GatewayAdapterPoolInterface $gatewayAdapterPool
     * @param array $clientArguments
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        GatewayAdapterPoolInterface $gatewayAdapterPool,
        array $clientArguments = []
    ) {
        $this->objectManager = $objectManager;
        $this->clientArguments = $clientArguments;
        $this->gatewayAdapterPool = $gatewayAdapterPool;
    }

    /**
     * @inheritDoc
     */
    public function create(string $code, array $arguments = []): ?GatewayAdapter
    {
        $adapterClassname = $this->gatewayAdapterPool->get($code);

        if (empty($adapterClassname) || !class_exists($adapterClassname)) {
            throw new LocalizedException(new Phrase('Gateway Adapter "%1" is invalid.', [$adapterClassname]));
        }

        return $this->objectManager->create($adapterClassname, $this->clientArguments);
    }
}
