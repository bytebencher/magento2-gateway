<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Validator;

use ByteBencher\Gateway\Api\Validator\ResultDataInterface;

class NullValidator extends AbstractValidator
{
    /**
     * @inheritDoc
     */
    protected function isResponseValid(array $rawResponse): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function getErrorMessages(array $rawResponse): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function fetchData($rawResponse): ?ResultDataInterface
    {
        return null;
    }
}
