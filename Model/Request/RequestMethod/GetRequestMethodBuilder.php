<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\Request\RequestMethod;

use Laminas\Http\Request;
use SR\Gateway\Model\Request\AbstractClientBuilder;

class GetRequestMethodBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject): array
    {
        return [
            self::KEY_REQUEST_METHOD => Request::METHOD_GET,
        ];
    }
}
