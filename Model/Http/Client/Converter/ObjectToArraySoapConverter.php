<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Http\Client\Converter;

use ByteBencher\Gateway\Api\Http\ConverterInterface;

class ObjectToArraySoapConverter implements ConverterInterface
{
    /**
     * @inheritDoc
     */
    public function convert($response): array
    {
        $response = (array) $response;
        foreach ($response as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $response[$key] = $this->convert($value);
            }
        }

        return $response;
    }
}
