<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http\Client\Converter;

use SR\Gateway\Api\Http\ConverterInterface;

class ObjectToArrayRestConverter implements ConverterInterface
{
    /**
     * @inheritDoc
     */
    public function convert($response)
    {
        $decoded = json_decode($response, true);
        //return $decoded !== null ? $decoded : [];
        return $decoded ?? [];
    }
}
