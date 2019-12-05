<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Phrase;
use SR\Gateway\Api\CommandPoolInterface;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Validator\ResultInterface;
use SR\Gateway\Exception\CommandException;

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
     * @return null|ResultInterface
     * @throws CommandException
     */
    protected function executeCommand($commandCode, array $arguments = [])
    {
        $command = null;

        if (!$this->canPerformCommand($commandCode)) {
            return $command;
        }

        // TODO: implement logic to prepare command arguments

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
     * @return bool
     */
    protected function canPerformCommand($commandCode)
    {
        //return (bool)$this->getConfiguredValue('can_' . $commandCode);
        return (bool)$this->config->getActive();
    }
}
