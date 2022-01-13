<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Phrase;

class HttpClient implements OptionSourceInterface
{
    public const REST = 1;
    public const SOAP = 2;

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::REST, 'label' => new Phrase('REST')],
            ['value' => self::SOAP, 'label' => new Phrase('SOAP')],
        ];
    }

    /**
     * Returns options in "key-value" format
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            self::REST => new Phrase('REST'),
            self::SOAP => new Phrase('SOAP'),
        ];
    }
}
