<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Http;

use ByteBencher\Gateway\Exception\ConverterException;

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
