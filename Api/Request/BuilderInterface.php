<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Request;

use ByteBencher\Gateway\Exception\RequestBuilderException;

/**
 * Interface BuilderInterface
 * @package ByteBencher\Gateway\Api\Request
 */
interface BuilderInterface
{
    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     *
     * @return array
     *
     * @throws RequestBuilderException
     */
    public function build(array $buildSubject): array;
}
