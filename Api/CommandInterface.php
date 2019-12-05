<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
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
    /**
     * Executes command basing on business object
     *
     * @param array $commandSubject
     * @return null|ResultInterface
     * @throws CommandException
     */
    public function execute(array $commandSubject);
}
