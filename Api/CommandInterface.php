<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api;

use ByteBencher\Gateway\Api\Validator\ResultInterface;
use ByteBencher\Gateway\Exception\CommandException;

/**
 * Interface CommandInterface
 * @package ByteBencher\Gateway\Api
 */
interface CommandInterface
{
    /**#@+
     * Arguments for Command execution
     */
    public const ARGUMENT_CONFIG = 'config';// \ByteBencher\Gateway\Api\Config\ConfigInterface;
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
