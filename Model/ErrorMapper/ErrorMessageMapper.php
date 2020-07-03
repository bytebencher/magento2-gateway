<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\ErrorMapper;

use SR\Gateway\Api\ErrorMapper\ErrorMessageMapperInterface;
use SR\Gateway\Api\ErrorMapper\MessageMappingDataInterface;

class ErrorMessageMapper implements ErrorMessageMapperInterface
{
    /**
     * @var MessageMappingDataInterface
     */
    private $messageMapping;

    /**
     * ErrorMessageMapper constructor.
     * @param MessageMappingDataInterface $messageMapping
     */
    public function __construct(MessageMappingDataInterface $messageMapping)
    {
        $this->messageMapping = $messageMapping;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(string $code)
    {
        $message = $this->messageMapping->get($code);
        return $message ?: $code;
    }
}
