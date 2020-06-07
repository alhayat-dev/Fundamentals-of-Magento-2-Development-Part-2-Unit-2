<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\RequireVerification\Observer\Frontend;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\State;

class Verification implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var State
     */
    private $state;

    /**
     * Verification constructor.
     * @param LoggerInterface $logger
     * @param State $state
     */
    public function __construct
    (
        LoggerInterface $logger,
        State $state
    ){
        $this->logger = $logger;
        $this->state = $state;
    }

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $order->setRequireVerification(1)->save();

        $this->logger->info('order saving...' . PHP_EOL, [$this->state->getAreaCode(), $observer->getEvent()->getOrder()->getData()]);
    }
}
