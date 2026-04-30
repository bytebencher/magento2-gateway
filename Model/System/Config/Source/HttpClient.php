<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Phrase;

class HttpClient implements OptionSourceInterface
{
    public const REST = 1;
    public const SOAP = 2;
    public const GUZZLE = 3;

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::REST, 'label' => new Phrase('REST (CURL Client)')],
            ['value' => self::SOAP, 'label' => new Phrase('SOAP (CURL Client)')],
            ['value' => self::GUZZLE, 'label' => new Phrase('GUZZLE Client')],
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
            self::REST => new Phrase('REST (CURL Client)'),
            self::SOAP => new Phrase('SOAP (CURL Client)'),
            self::GUZZLE => new Phrase('GUZZLE Client'),
        ];
    }
}
