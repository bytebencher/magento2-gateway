<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Command;

use Magento\Framework\Phrase;
use SR\Gateway\Api\CommandInterface;
use SR\Gateway\Api\ErrorMapper\ErrorMessageMapperInterface;
use SR\Gateway\Api\Http\Client\ClientFactoryInterface;
use SR\Gateway\Api\Http\Client\ClientInterface;
use SR\Gateway\Api\Http\TransferFactoryInterface;
use SR\Gateway\Api\Http\TransferInterface;
use SR\Gateway\Api\LoggerInterface;
use SR\Gateway\Api\Request\BuilderInterface;
use SR\Gateway\Api\Response\HandlerInterface;
use SR\Gateway\Api\Validator\ResultInterface;
use SR\Gateway\Api\Validator\ValidatorInterface;
use SR\Gateway\Exception\ClientException;
use SR\Gateway\Exception\CommandException;
use SR\Gateway\Exception\RequestBuilderException;
use SR\Gateway\Exception\ResponseHandlerException;
use SR\Gateway\Exception\TransferBuilderException;

/**
 * Class GatewayCommand
 * @package SR\Gateway\Model\Command
 */
class GatewayCommand implements CommandInterface
{
    /**
     * @var BuilderInterface
     */
    protected $requestBuilder;

    /**
     * @var TransferFactoryInterface
     */
    protected $transferFactory;

    /**
     * @var ClientFactoryInterface
     */
    protected $clientFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var HandlerInterface|null
     */
    protected $handler;

    /**
     * @var ValidatorInterface|null
     */
    protected $validator;

    /**
     * @var ErrorMessageMapperInterface|null
     */
    protected $errorMessageMapper;

    /**
     * GatewayCommand constructor.
     * @param BuilderInterface $requestBuilder
     * @param TransferFactoryInterface $transferFactory
     * @param ClientFactoryInterface $clientFactory
     * @param LoggerInterface $logger
     * @param HandlerInterface|null $handler
     * @param ValidatorInterface|null $validator
     * @param ErrorMessageMapperInterface|null $errorMessageMapper
     */
    public function __construct(
        BuilderInterface $requestBuilder,
        TransferFactoryInterface $transferFactory,
        ClientFactoryInterface $clientFactory,
        LoggerInterface $logger,
        HandlerInterface $handler = null,
        ValidatorInterface $validator = null,
        ErrorMessageMapperInterface $errorMessageMapper = null
    ) {
        $this->requestBuilder = $requestBuilder;
        $this->transferFactory = $transferFactory;
        $this->clientFactory = $clientFactory;
        $this->logger = $logger;
        $this->handler = $handler;
        $this->validator = $validator;
        $this->errorMessageMapper = $errorMessageMapper;
    }

    /**
     * @inheritDoc
     */
    public function execute(array $commandSubject)
    {
        $transferO = null;

        try {
            /** @var TransferInterface $transferO */
            $transferO = $this->transferFactory->create(
                $this->requestBuilder->build($commandSubject)
            );

            /** @var ClientInterface $client */
            $client = $this->clientFactory->create($commandSubject);

            /** @var array $response */
            $response = $client->placeRequest($transferO);

            if ($this->validator !== null) {
                $validationSubject = array_merge($commandSubject, ['response' => $response]);

                /** @var ResultInterface $result */
                $result = $this->validator->validate($validationSubject);

                if (!$result->isValid()) {
                    // NOTE: log method is executed before ErrorProcessing because ErrorProcessing throws an exception
                    //$this->log(['transfer' => $transferO, 'result' => $result, 'validationSubject' => $validationSubject]);

                    $this->processErrors($result);
                }
            }

            if ($this->handler) {
                $this->handler->handle(
                    $commandSubject,
                    $response
                );
            }
        } catch (RequestBuilderException | TransferBuilderException | ResponseHandlerException | ClientException $e) {
            // NOTE: log method is executed before exception throwing
            //$this->log(['transfer' => $transferO, 'exception' => $e]);

            $this->logger->debug($e->getMessage());
            throw new CommandException(new Phrase($e->getMessage()), $e);
        }
    }

    /**
     * Tries to map error messages from validation result and logs processed message.
     * Throws an exception with mapped message or default error.
     *
     * @param ResultInterface $result
     * @throws CommandException
     */
    protected function processErrors(ResultInterface $result)
    {
        $messages = [];

        /** @var Phrase $failPhrase */
        foreach ($result->getFailsDescription() as $failPhrase) {
            $message = $failPhrase->render();

            // error messages mapper can be not configured if custom error messages handler does not exist.
            if ($this->errorMessageMapper !== null) {
                $mapped = (string) $this->errorMessageMapper->getMessage($message);
                if (!empty($mapped)) {
                    $messages[] = $mapped;
                    $message = $mapped;
                }
            }

            $this->logger->debug(new Phrase('Gateway Error :: ' . $message));
        }

        throw new CommandException(
            !empty($messages)
                ? new Phrase(implode(PHP_EOL, $messages))
                : new Phrase('Request has been declined. Please try again later.')
        );
    }
}
