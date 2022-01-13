<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\ErrorMapper;

use SR\Gateway\Api\ErrorMapper\MessageMappingDataInterface;

class NullMappingData implements MessageMappingDataInterface
{
    /**
     * @inheritDoc
     */
    public function merge(array $mappings) : void
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
