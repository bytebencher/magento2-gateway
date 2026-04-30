<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Response;

use Magento\Framework\ObjectManager\TMapFactory;
use Magento\Framework\ObjectManagerInterface;
use ByteBencher\Gateway\Api\Config\ConfigInterface;
use ByteBencher\Gateway\Api\Response\HandlerInterface;

class HandlerChain implements HandlerInterface
{
    /**
     * @var HandlerInterface[]
     */
    private $handlers;
    protected ConfigInterface $config;

    /**
     * @param TMapFactory $tmapFactory
     * @param ConfigInterface $config
     * @param array $handlers
     */
    public function __construct(
        TMapFactory $tmapFactory,
        ConfigInterface $config,
        array $handlers = []
    ) {
        $this->config = $config;

        $this->handlers = $tmapFactory->create([
            'array' => $handlers,
            'type' => HandlerInterface::class,
            'objectCreationStrategy' => $this->getCreationStrategyClosure(),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response): void
    {
        foreach ($this->handlers as $handler) {
            $handler->handle($handlingSubject, $response);
        }
    }

    /**
     * TMap Closure objectCreationStrategy
     * NOTE: it is needed to set the same Config object in all children of this HandlerChain (Parent)
     * NOTE: there is no need to pass Config object via di.xml for all Handlers
     *
     * @see \Magento\Framework\ObjectManager\TMap::initObject
     *
     * @return \Closure
     */
    private function getCreationStrategyClosure()
    {
        return \Closure::bind(function (...$args) {
            /** @var ObjectManagerInterface $objectManager */
            $objectManager = $args[0];
            $handlerClassName = $args[1];

            /** @var HandlerInterface $handler */
            $handler = $objectManager->create($handlerClassName, ['config' => $this->config]);
            return $handler;
        }, $this);
    }
}
