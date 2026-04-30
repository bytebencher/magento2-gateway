<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Http\Client\Converter;

use ByteBencher\Gateway\Api\Http\ConverterInterface;

class ObjectToArrayRestConverter implements ConverterInterface
{
    /**
     * @inheritDoc
     */
    public function convert($response): array
    {
        $decoded = \Safe\json_decode($response, true);
        //return $decoded !== null ? $decoded : [];
        return $decoded ?? [];
    }
}
