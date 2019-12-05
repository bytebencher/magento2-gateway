<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Validator;

class NullValidator extends AbstractValidator
{
    /**
     * @inheritDoc
     */
    protected function isResponseValid(array $rawResponse)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function getErrorMessages(array $rawResponse)
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function fetchData($rawResponse)
    {
        return null;
    }
}
