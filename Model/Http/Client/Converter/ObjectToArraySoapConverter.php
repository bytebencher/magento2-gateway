<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\Http\Client\Converter;

use SR\Gateway\Api\Http\ConverterInterface;

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
