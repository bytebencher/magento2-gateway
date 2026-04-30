<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Request\RequestMethod;

use Laminas\Http\Request;
use ByteBencher\Gateway\Model\Request\AbstractClientBuilder;

class PostRequestMethodBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        return [
            self::KEY_REQUEST_METHOD => Request::METHOD_POST,
        ];
    }
}
