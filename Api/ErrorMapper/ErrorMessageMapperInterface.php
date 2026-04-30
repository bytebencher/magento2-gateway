<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\ErrorMapper;

/**
 * Interface ErrorMessageMapperInterface
 *
 * @package ByteBencher\Gateway\Api\ErrorMapper
 */
interface ErrorMessageMapperInterface
{
    /**
     * Returns customized error message by provided code.
     * If message not found `null` will be returned.
     *
     * @param string $code Error Code or Raw Message to map
     *
     * @return string|null
     */
    public function getMessage(string $code): ?string;
}
