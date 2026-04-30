<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model\Validator;

use ByteBencher\Gateway\Api\Validator\ResultDataInterface;
use ByteBencher\Gateway\Api\Validator\ResultDataInterfaceFactory;
use ByteBencher\Gateway\Api\Validator\ResultInterface;
use ByteBencher\Gateway\Api\Validator\ResultInterfaceFactory;
use ByteBencher\Gateway\Api\Validator\ValidatorInterface;

abstract class AbstractValidator implements ValidatorInterface
{
    protected ResultInterfaceFactory $resultFactory;
    protected ResultDataInterfaceFactory $resultDataFactory;

    /**
     * @param ResultInterfaceFactory $resultFactory
     * @param ResultDataInterfaceFactory $resultDataFactory
     */
    public function __construct(
        ResultInterfaceFactory $resultFactory,
        ResultDataInterfaceFactory $resultDataFactory
    ) {
        $this->resultFactory = $resultFactory;
        $this->resultDataFactory = $resultDataFactory;
    }

    /**
     * Checks whether response valid or not
     *
     * @param array $rawResponse
     *
     * @return bool
     */
    abstract protected function isResponseValid(array $rawResponse): bool;

    /**
     * Returns list of errors (Messages or corresponding Codes)
     *
     * NOTE: put Error Codes into messages.
     * @see \ByteBencher\Gateway\Model\ErrorMapper\ErrorMappingData to manage Mappings
     *
     * @param array $rawResponse
     *
     * @return array
     */
    abstract protected function getErrorMessages(array $rawResponse): array;

    /**
     * Fetches and Returns data from raw response
     *
     * @param mixed $rawResponse Dataset of Response [also can contain some request data]
     *
     * @return ResultDataInterface|null
     */
    abstract protected function fetchData($rawResponse): ?ResultDataInterface;

    /**
     * @inheritDoc
     */
    public function validate(array $validationSubject): ResultInterface
    {
        $rawResponse = $validationSubject['response']['object'] ?? [];

        $isValid = $this->isResponseValid($rawResponse);

        $errorMessages = !$isValid ? $this->getErrorMessages($rawResponse) : [];

        $result = $this->createResult($isValid, $errorMessages);

        if ($result->isValid()) {
            $result->setData($this->fetchData($rawResponse) ?: null);
        }

        return $result;
    }

    /**
     * Factory method
     *
     * @param bool  $isValid
     * @param array $fails
     *
     * @return ResultInterface
     */
    protected function createResult(bool $isValid, array $fails = []): ResultInterface
    {
        return $this->resultFactory->create([
            'isValid' => (bool)$isValid,
            'failsDescription' => $fails,
        ]);
    }
}
