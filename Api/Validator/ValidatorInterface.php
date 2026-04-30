<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Validator;

/**
 * Interface ValidatorInterface
 * @package ByteBencher\Gateway\Api\Validator
 */
interface ValidatorInterface
{
    /**
     * Performs domain-related validation for business object
     *
     * @param array $validationSubject
     * @return ResultInterface
     */
    public function validate(array $validationSubject): ResultInterface;
}
