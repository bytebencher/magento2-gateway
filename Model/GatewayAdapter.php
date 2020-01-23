<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Phrase;
use SR\Gateway\Api\CommandInterface;
use SR\Gateway\Api\CommandPoolInterface;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Validator\ResultInterface;
use SR\Gateway\Exception\CommandException;
use SR\Gateway\Model\Config\Config;

class GatewayAdapter
{
    /**
     * @var CommandPoolInterface
     */
    protected $commandPool;

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * GatewayAdapter constructor.
     * @param CommandPoolInterface $commandPool
     * @param ConfigInterface $config
     */
    public function __construct(
        CommandPoolInterface $commandPool,
        ConfigInterface $config
    ) {
        $this->commandPool = $commandPool;
        $this->config = $config;
    }

    /**
     * Executes command
     *
     * @param string $commandCode
     * @param array $arguments
     *
     * @return null|ResultInterface
     *
     * @throws CommandException
     */
    protected function executeCommand($commandCode, array $arguments = [])
    {
        $storeId = $arguments[CommandInterface::ARGUMENT_SUBJECT]['store_id'] ?? null;
        $command = null;

        if (!$this->canPerformCommand($commandCode, $storeId)) {
            return $command;
        }

        $this->prepareCommandArguments($commandCode, $arguments);

        try {
            $command = $this->commandPool->get($commandCode);
        } catch (NotFoundException $e) {
            throw new CommandException(new Phrase('Gateway command "%1" has not been found.', [$commandCode]));
        }

        return $command->execute($arguments);
    }

    /**
     * Whether gateway command is supported and can be executed
     *
     * @param string $commandCode
     * @param int|null $storeId [optional]
     *
     * @return bool
     */
    protected function canPerformCommand($commandCode, $storeId = null)
    {
        return $this->config->getActive($storeId)
            && $this->config->getValue('can_' . $commandCode, Config::GROUP_PATH_GATEWAY, $storeId);
    }

    /**
     * Prepares Command Arguments list [mutator]
     *
     * @param string $commandCode Code of the Command
     * @param array $arguments List or arguments to modify
     *
     * @return $this
     */
    protected function prepareCommandArguments($commandCode, array &$arguments = [])
    {
        //$arguments[CommandInterface::ARGUMENT_CONFIG] = $this->config;

        return $this;
    }
}
