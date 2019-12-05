<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http\Adapter;

use Magento\Framework\HTTP\Adapter\Curl as MagentoCurlAdapter;
use Zend\Http\Response as HttpResponse;

class CurlAdapter extends MagentoCurlAdapter
{
    /**
     * Performs curl_exec and returns Response Object
     *
     * @return HttpResponse
     */
    public function singleExec()
    {
        return HttpResponse::fromString(curl_exec($this->_getResource()));
    }
}
