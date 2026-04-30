<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

declare(strict_types=1);

namespace ByteBencher\Gateway\Model;

class GatewayAdapterPool implements GatewayAdapterPoolInterface
{
    protected array $classNames = [
        //'key' => 'class-name',
    ];

    public function __construct(array $classNames = [])
    {
        $this->merge($classNames);
    }

    /**
     * @inheritDoc
     */
    public function merge(array $classNames): void
    {
        $this->classNames = array_replace_recursive($this->classNames, $classNames);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        return $this->classNames[$key] ?? null;
    }
}
