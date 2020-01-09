<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Validator;

use SR\Gateway\Api\Validator\ResultDataInterface;
use SR\Gateway\Api\Validator\ResultDataInterfaceFactory;
use SR\Gateway\Api\Validator\ResultInterface;
use SR\Gateway\Api\Validator\ResultInterfaceFactory;
use SR\Gateway\Api\Validator\ValidatorInterface;

abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var ResultInterfaceFactory
     */
    protected $resultFactory;

    /**
     * @var ResultDataInterfaceFactory
     */
    protected $resultDataFactory;

    /**
     * AbstractValidator constructor.
     *
     * @param ResultInterfaceFactory     $resultFactory
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
     * @return boolean
     */
    abstract protected function isResponseValid(array $rawResponse);

    /**
     * Returns list of errors (Messages or corresponding Codes)
     *
     * NOTE: put Error Codes into messages.
     * @see \SR\Gateway\Model\ErrorMapper\ErrorMappingData to manage Mappings
     *
     * @param array $rawResponse
     *
     * @return array
     */
    abstract protected function getErrorMessages(array $rawResponse);

    /**
     * Fetches and Returns data from raw response
     *
     * @param mixed $rawResponse Dataset of Response [also can contain some request data]
     *
     * @return ResultDataInterface|null
     */
    abstract protected function fetchData($rawResponse);

    /**
     * @inheritDoc
     */
    public function validate(array $validationSubject)
    {
        $rawResponse = $validationSubject['response']['object'] ?? [];

        $isValid = $this->isResponseValid($rawResponse);

        $errorMessages = !$isValid ? $this->getErrorMessages($rawResponse) : [];

        /** @var ResultInterface $result */
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
    protected function createResult($isValid, array $fails = [])
    {
        return $this->resultFactory->create([
            'isValid' => (bool)$isValid,
            'failsDescription' => $fails,
        ]);
    }
}
