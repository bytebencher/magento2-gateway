<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\ErrorMapper;

use ByteBencher\Gateway\Api\ErrorMapper\ErrorMessageMapperInterface;
use ByteBencher\Gateway\Api\ErrorMapper\MessageMappingDataInterface;

class ErrorMessageMapper implements ErrorMessageMapperInterface
{
    private MessageMappingDataInterface $messageMapping;

    /**
     * @param MessageMappingDataInterface $messageMapping
     */
    public function __construct(MessageMappingDataInterface $messageMapping)
    {
        $this->messageMapping = $messageMapping;
    }

    /**
     * @inheritDoc
     */
    public function getMessage(string $code): ?string
    {
        $message = $this->messageMapping->get($code);
        return $message ?: $code;
    }
}
