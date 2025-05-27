<?php
declare(strict_types=1);

namespace SR\Gateway\Model\Response;

use Magento\Framework\ObjectManager\TMapFactory;
use SR\Gateway\Api\Config\ConfigInterface;
use SR\Gateway\Api\Response\DataModifierInterface;
use SR\Gateway\Api\Validator\ResultInterface;

class DataModifierChain implements DataModifierInterface
{
    /** @var DataModifierInterface[] */
    private $modifiers;
    private ConfigInterface $config;

    public function __construct(
        TMapFactory $tmapFactory,
        ConfigInterface $config,
        array $modifiers = []
    ) {
        $this->config = $config;
        $this->modifiers = $tmapFactory->create([
            'array' => $modifiers,
            'type'  => DataModifierInterface::class,
            'objectCreationStrategy' => $this->getCreationClosure(),
        ]);
    }

    public function modify(array $commandSubject, ResultInterface $result): void
    {
        foreach ($this->modifiers as $modifier) {
            $modifier->modify($commandSubject, $result);
        }
    }

    private function getCreationClosure(): \Closure
    {
        return \Closure::bind(function ($om, $class) {
            return $om->create($class, ['config' => $this->config]);
        }, $this);
    }
}
