<?php
declare(strict_types=1);

namespace ByteBencher\Gateway\Api\Response;

use ByteBencher\Gateway\Api\Validator\ResultInterface;

interface DataModifierInterface
{
    /**
     * Modify or enrich the validated command result.
     *
     * @param array $commandSubject
     * @param ResultInterface $result
     */
    public function modify(array $commandSubject, ResultInterface $result): void;
}
