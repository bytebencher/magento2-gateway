<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Validator;

use Magento\Framework\Phrase;
use ByteBencher\Gateway\Api\Validator\ResultDataInterface;
use ByteBencher\Gateway\Api\Validator\ResultInterface;

class Result implements ResultInterface
{
    protected bool $isValid;

    /**
     * @var Phrase[]
     */
    protected array $failsDescription;
    protected ?ResultDataInterface $resultData = null;

    /**
     * @param bool $isValid
     * @param array $failsDescription
     */
    public function __construct(
        bool $isValid,
        array $failsDescription = []
    ) {
        $this->isValid = $isValid;
        $this->failsDescription = $failsDescription;
    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @inheritDoc
     */
    public function getFailsDescription(): array
    {
        return $this->failsDescription;
    }

    /**
     * @inheritDoc
     */
    public function setData($data = null): self
    {
        $this->resultData = $data;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getData(): ?ResultDataInterface
    {
        return $this->resultData;
    }
}
