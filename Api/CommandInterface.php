<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Api;

use SR\Gateway\Api\Validator\ResultInterface;
use SR\Gateway\Exception\CommandException;

/**
 * Interface CommandInterface
 * @package SR\Gateway\Api
 */
interface CommandInterface
{
    /**#@+
     * Arguments for Command execution
     */
    public const ARGUMENT_CONFIG = 'config';// \SR\Gateway\Api\Config\ConfigInterface;
    public const ARGUMENT_SUBJECT = 'subject';
    /**#@- */

    /**
     * Executes command basing on business object
     *
     * @param array $commandSubject
     *
     * @return null|ResultInterface
     *
     * @throws CommandException
     */
    public function execute(array $commandSubject): ?ResultInterface;
}
