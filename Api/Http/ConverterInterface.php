<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\Http;

use SR\Gateway\Exception\ConverterException;

interface ConverterInterface
{
    /**
     * Converts gateway response to ENV structure
     *
     * @param mixed $response
     *
     * @return array
     *
     * @throws ConverterException
     */
    public function convert($response): array;
}
