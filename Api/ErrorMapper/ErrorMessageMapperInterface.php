<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Api\ErrorMapper;

/**
 * Interface ErrorMessageMapperInterface
 *
 * @package SR\Gateway\Api\ErrorMapper
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
