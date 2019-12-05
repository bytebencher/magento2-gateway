<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Mode implements OptionSourceInterface
{
    const PRODUCTION = 1;
    const SANDBOX = 2;

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::PRODUCTION, 'label' => __('Production')],
            ['value' => self::SANDBOX, 'label' => __('Sandbox')],
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
            self::PRODUCTION => __('Production'),
            self::SANDBOX => __('Sandbox'),
        ];
    }
}
