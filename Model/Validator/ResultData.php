<?php
/**
 * Copyright © 2020 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Validator;

use Magento\Framework\DataObject;
use SR\Gateway\Api\Validator\ResultDataInterface;

class ResultData implements ResultDataInterface
{
    /**
     * @var mixed
     */
    private $rawData;

    /**
     * Specified Entity
     *
     * @var DataObject|null
     */
    private ?DataObject $entity;

    /**
     * List of Entities
     *
     * @var DataObject[]
     */
    private array $items;

    /**
     * ResultData constructor.
     * @param mixed|null $rawData
     */
    public function __construct($rawData = null)
    {
        if ($rawData !== null) {
            $this->setRawData($rawData);
        }
    }

    /**
     * @inheritDoc
     */
    public function getRawData()
    {
        return $this->rawData;
    }

    /**
     * @inheritDoc
     */
    public function setRawData($dataset = null): self
    {
        $this->rawData = $dataset;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEntity(): DataObject
    {
        if ($this->entity === null) {
            return current($this->getItems());
        }

        return $this->entity;
    }

    /**
     * @inheritDoc
     */
    public function setEntity(DataObject $dataset): self
    {
        $this->entity = $dataset;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function setItems(array $items = []): self
    {
        $this->items = $items;
        return $this;
    }
}
