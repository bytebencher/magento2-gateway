<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model\ErrorMapper;

use SR\Gateway\Api\ErrorMapper\MessageMappingDataInterface;

class ErrorMappingData implements MessageMappingDataInterface
{
    /**
     * TODO: extend the list with new pairs 'ErrorCode' => 'ErrorDescription'
     *
     * Mappings of Error Codes
     */
    protected array $mappings = [
        //'-100-' => 'SAMPLE of the error description.',
    ];

    /**
     * ErrorMappingData constructor
     *
     * @param array $mappings
     */
    public function __construct(array $mappings = [])
    {
        $this->merge($mappings);
    }

    /**
     * @inheritDoc
     */
    public function merge(array $mappings): void
    {
        $this->mappings = array_replace_recursive($this->mappings, $mappings);
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null)
    {
        return $this->mappings[(string)$key] ?? $default;
    }
}
