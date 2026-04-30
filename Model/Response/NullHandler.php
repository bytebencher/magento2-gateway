<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Response;

use ByteBencher\Gateway\Api\Response\HandlerInterface;

class NullHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handle(array $handlingSubject, array $response): void
    {

    }
}
