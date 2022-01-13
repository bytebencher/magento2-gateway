<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\Request;

use Magento\Framework\ObjectManager\TMapFactory;
use Magento\Framework\ObjectManagerInterface;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Request\BuilderInterface;

class BuilderComposite implements BuilderInterface
{
    /**
     * @var BuilderInterface[]
     */
    protected $builders;
    protected ConfigInterface $config;

    /**
     * @param TMapFactory $tmapFactory
     * @param ConfigInterface $config
     * @param array $builders
     */
    public function __construct(
        TMapFactory $tmapFactory,
        ConfigInterface $config,
        array $builders = []
    ) {
        $this->config = $config;

        $this->builders = $tmapFactory->create([
            'array' => $builders,
            'type' => BuilderInterface::class,
            'objectCreationStrategy' => $this->getCreationStrategyClosure(),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        $result = [];
        foreach ($this->builders as $builder) {
            $result = $this->merge($result, $builder->build($buildSubject));
        }

        return $result;
    }

    /**
     * Merge-function for builders
     *
     * @param array $result
     * @param array $builder
     * @return array
     */
    protected function merge(array $result, array $builder): array
    {
        return array_replace_recursive($result, $builder);
    }

    /**
     * TMap Closure objectCreationStrategy
     * NOTE: it is needed to set the same Config object in all children of this CompositeBuilder (Parent)
     * NOTE: there is no need to pass Config object via di.xml for all Builders
     *
     * @see \Magento\Framework\ObjectManager\TMap::initObject
     *
     * @return \Closure
     */
    private function getCreationStrategyClosure(): \Closure
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
