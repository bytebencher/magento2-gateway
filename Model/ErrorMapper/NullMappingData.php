<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\ErrorMapper;

use SR\Gateway\Api\ErrorMapper\MessageMappingDataInterface;

class NullMappingData implements MessageMappingDataInterface
{
    /**
     * @inheritDoc
     */
    public function merge(array $config)
    {
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        return null;
    }
}
