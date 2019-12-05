<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Request\RequestMethod;

use SR\Gateway\Model\Request\AbstractClientBuilder;
use Zend\Http\Request;

class PostRequestMethodBuilder extends AbstractClientBuilder
{
    /**
     * @inheritDoc
     */
    public function build(array $buildSubject)
    {
        return [
            self::KEY_REQUEST_METHOD => Request::METHOD_POST,
        ];
    }
}
