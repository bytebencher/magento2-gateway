<?php
/**
 * Copyright © 2020 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http\Client\Converter;

use SR\Gateway\Api\Http\ConverterInterface;

class ObjectToArraySoapConverter implements ConverterInterface
{
    /**
     * @inheritDoc
     */
    public function convert($response)
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
