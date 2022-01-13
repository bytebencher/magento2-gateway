<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\Validator;

/**
 * Interface ResultInterface
 * @package SR\Gateway\Api\Validator
 */
interface ResultInterface
{
    /**
     * Returns validation result
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Returns list of fails description
     *
     * @return array
     */
    public function getFailsDescription(): array;

    /**
     * Set the Fetched Data and convert it into ResultDataInterface
     *
     * @param ResultDataInterface|null $data
     *
     * @return $this
     */
    public function setData($data = null): self;

    /**
     * Get Fetched Data
     *
     * @return ResultDataInterface|null
     */
    public function getData(): ?ResultDataInterface;
}
