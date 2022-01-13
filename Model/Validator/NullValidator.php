<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Validator;

use SR\Gateway\Api\Validator\ResultDataInterface;

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
