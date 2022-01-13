<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Api\Response;

use SR\Gateway\Exception\ResponseHandlerException;

/**
 * Interface HandlerInterface
 * @package SR\Gateway\Api\Response
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
