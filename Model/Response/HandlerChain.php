<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Response;

use Magento\Framework\ObjectManager\TMapFactory;
use Magento\Framework\ObjectManagerInterface;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Request\BuilderInterface;
use SR\Gateway\Api\Response\HandlerInterface;

class HandlerChain implements HandlerInterface
{
    /**
     * @var HandlerInterface[]
     */
    private $handlers;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * HandlerChain constructor.
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
    public function handle(array $handlingSubject, array $response)
    {
        foreach ($this->handlers as $handler) {
            $handler->handle($handlingSubject, $response);
        }
    }

    /**
     * TMap Closure objectCreationStrategy
     * NOTE: it is needed to set the same Config object in all children of this HandlerChain (Parent)
     * NOTE: there is no need to pass Config object via di.xml for all Builders
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
            $builderClassName = $args[1];

            /** @var BuilderInterface $builder */
            $builder = $objectManager->create($builderClassName, ['config' => $this->config]);
            return $builder;
        }, $this);
    }
}
