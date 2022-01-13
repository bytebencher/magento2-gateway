<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Http\Adapter;

use Laminas\Http\Headers as HttpHeaders;
use Laminas\Http\Response as HttpResponse;
use Magento\Framework\HTTP\Adapter\Curl as MagentoCurlAdapter;

class CurlAdapter extends MagentoCurlAdapter
{
    /**
     * Performs curl_exec and returns Response Object
     *
     * @return HttpResponse
     * @throws \Safe\Exceptions\CurlException
     */
    public function singleExec(): HttpResponse
    {
        $response = HttpResponse::fromString(\Safe\curl_exec($this->_getResource()));

        // FIXME: headers WORKAROUND
        //     NOTE: some Remote Services respond with "Transfer-Encoding: chunked" http-header,
        //         but the BODY is NOT valid Chunked content.
        //         Thus, the Header is just removed.

        /** @var HttpHeaders $headers */
        $headers = $response->getHeaders();
        if ($headers->has('Transfer-Encoding')
            && strtolower($headers->get('Transfer-Encoding')->getFieldValue()) === 'chunked'
        ) {
            $headers->removeHeader($headers->get('Transfer-Encoding'));
        }

        return $response;
    }
}
