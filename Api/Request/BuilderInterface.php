<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Api\Request;

use SR\Gateway\Exception\RequestBuilderException;

/**
 * Interface BuilderInterface
 * @package SR\Gateway\Api\Request
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
