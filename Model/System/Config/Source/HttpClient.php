<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class HttpClient implements OptionSourceInterface
{
    const REST = 1;
    const SOAP = 2;

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::REST, 'label' => __('REST')],
            ['value' => self::SOAP, 'label' => __('SOAP')],
        ];
    }

    /**
     * Returns options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::REST => __('REST'),
            self::SOAP => __('SOAP'),
        ];
    }
}
