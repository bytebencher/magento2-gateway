<?php
/**
 * Copyright © 2019 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace SR\Gateway\Model\Command;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\ObjectManager\TMapFactory;
use Magento\Framework\Phrase;
use SR\Gateway\Api\CommandInterface;
use SR\Gateway\Api\CommandPoolInterface;

class CommandPool implements CommandPoolInterface
{
    /**
     * @var CommandInterface[]
     */
    protected $commands;

    /**
     * CommandPool constructor.
     * @param TMapFactory $tmapFactory
     * @param array $commands
     */
    public function __construct(
        TMapFactory $tmapFactory,
        array $commands = []
    ) {
        $this->commands = $tmapFactory->create([
            'array' => $commands,
            'type' => CommandInterface::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function get($commandCode)
    {
        if (!isset($this->commands[$commandCode])) {
            throw new NotFoundException(new Phrase('Command %1 does not exist.', [$commandCode]));
        }

        return $this->commands[$commandCode];
    }
}
