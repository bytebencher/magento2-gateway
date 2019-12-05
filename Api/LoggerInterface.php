<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api;

use Magento\Framework\Phrase;

/**
 * Interface LoggerInterface
 * @package SR\Gateway\Api
 */
interface LoggerInterface
{
    /**
     * Logs information (data-set) which is used for debug (file-based)
     *
     * @param array|string|Phrase $data
     * @param array|null $maskKeys
     * @param bool|null $forceDebug
     * @return bool|void Whether the record has been processed
     */
    public function debug($data, array $maskKeys = null, $forceDebug = null);

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return void|null
     */
    public function critical($message, array $context = []);

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return void|null
     */
    public function info($message, array $context = []);

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function error($message, array $context = []);

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function warning($message, array $context = []);

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     * @return void
     */
    public function notice($message, array $context = []);
}
