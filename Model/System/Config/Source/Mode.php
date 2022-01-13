<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Phrase;

class Mode implements OptionSourceInterface
{
    public const PRODUCTION = 1;
    public const SANDBOX = 2;

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::PRODUCTION, 'label' => new Phrase('Production')],
            ['value' => self::SANDBOX, 'label' => new Phrase('Sandbox')],
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
            self::PRODUCTION => new Phrase('Production'),
            self::SANDBOX => new Phrase('Sandbox'),
        ];
    }
}
