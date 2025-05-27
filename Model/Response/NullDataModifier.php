<?php
declare(strict_types=1);

namespace SR\Gateway\Model\Response;

use SR\Gateway\Api\Response\DataModifierInterface;
use SR\Gateway\Api\Validator\ResultInterface;
use SR\Gateway\Api\Validator\ResultDataInterface;

class NullDataModifier implements DataModifierInterface
{
    /**
     * Stub implementation of DataModifierInterface.
     *
     * This class demonstrates how to transform or filter the validated response
     * payload before it is returned to the caller. A DataModifier can:
     *   - Filter out items
     *   - Enrich each item with additional fields
     *   - Rename keys, cast types, or flatten nested structures
     *   - Completely clear the payload if needed
     *
     * To implement your own modifier:
     * 1. Implement modify().
     * 2. Retrieve the ResultDataInterface via $result->getData().
     * 3. Use getItems() / setItems(), or replace the entire data via setData().
     *
     * Example use-case:
     *   - Remove items missing an SKU
     *   - Convert price in cents → dollars
     *   - Add a timestamp to each item
     *
     */

    /**
     * Example implementation of modify().
     *
     * @param array            $commandSubject
     * @param ResultInterface  $result
     */
    public function modify(array $commandSubject, ResultInterface $result): void
    {
        /**
        $dataObject = $result->getData();
        if ($dataObject instanceof ResultDataInterface) {

            foreach ($dataObject->getItems() as $item) {
                // modify item
            }
        }
        **/
    }
}
