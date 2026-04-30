<?php
/*
 * Copyright © 2022 ByteBencher. All rights reserved.
 * See LICENCE file for license details.
 */

namespace ByteBencher\Gateway\Model;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Phrase;
use ByteBencher\Gateway\Api\CommandInterface;
use ByteBencher\Gateway\Api\CommandPoolInterface;
use ByteBencher\Gateway\Api\Config\ConfigInterface;
use ByteBencher\Gateway\Api\Validator\ResultInterface;
use ByteBencher\Gateway\Exception\CommandException;
use ByteBencher\Gateway\Model\Config\Config;

class GatewayAdapter
{
    protected CommandPoolInterface $commandPool;
    protected ConfigInterface $config;

    /**
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
    protected function executeCommand(string $commandCode, array $arguments = []): ?ResultInterface
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
    protected function canPerformCommand(string $commandCode, $storeId = null): bool
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
    protected function prepareCommandArguments(string $commandCode, array &$arguments = []): self
    {
        //$arguments[CommandInterface::ARGUMENT_CONFIG] = $this->config;

        return $this;
    }
}
