<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Api\Response;

use ByteBencher\Gateway\Exception\ResponseHandlerException;

/**
 * Interface HandlerInterface
 * @package ByteBencher\Gateway\Api\Response
 */
interface HandlerInterface
{
    /**
     * Handles response
     *
     * @param array $handlingSubject
     * @param array $response
     *
     * @return void
     *
     * @throws ResponseHandlerException
     */
    public function handle(array $handlingSubject, array $response): void;
}
