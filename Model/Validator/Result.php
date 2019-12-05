<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Validator;

use Magento\Framework\Phrase;
use SR\Gateway\Api\Validator\ResultDataInterface;
use SR\Gateway\Api\Validator\ResultInterface;

class Result implements ResultInterface
{
    /**
     * @var bool
     */
    protected $isValid;

    /**
     * @var Phrase[]
     */
    protected $failsDescription;

    /**
     * @var ResultDataInterface|null
     */
    protected $resultData;

    /**
     * Result constructor.
     * @param null|bool $isValid
     * @param array $failsDescription
     */
    public function __construct(
        $isValid,
        array $failsDescription = []
    ) {
        $this->isValid = (bool)$isValid;
        $this->failsDescription = $failsDescription;
    }

    /**
     * @inheritDoc
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @inheritDoc
     */
    public function getFailsDescription()
    {
        return $this->failsDescription;
    }

    /**
     * @inheritDoc
     */
    public function setData($data = null)
    {
        $this->resultData = $data;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return $this->resultData;
    }
}
