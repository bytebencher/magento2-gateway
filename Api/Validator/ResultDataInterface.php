<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Api\Validator;

use Magento\Framework\DataObject;

interface ResultDataInterface
{
    /**
     * Get Entity/Collection/Dataset as it was passed to the ResultDataObject
     *
     * @return mixed
     */
    public function getRawData();

    /**
     * Set Raw Data
     *
     * @param mixed $dataset Entity, Collection or Dataset
     * @return $this
     */
    public function setRawData($dataset = null);

    /**
     * Get Single Entity (or another Data-set) which uses DataObject api and structure
     * NOTE: can be the first Item of the Items Collection
     *
     * @return DataObject
     */
    public function getEntity();

    /**
     * Set Single Entity
     *
     * @param DataObject $dataset Dataset of the Entity
     * @return $this
     */
    public function setEntity(DataObject $dataset);

    /**
     * Get Collection of Entities (another Data-sets) which use DataObject api and structure
     *
     * @return DataObject[]
     */
    public function getItems();

    /**
     * Set Items
     *
     * @param DataObject[] $items Collection (array) of DataObjects
     * @return mixed
     */
    public function setItems(array $items = []);
}
