<?php

namespace Tools\Factory\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Queue implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $queue = new \Tools\Service\Queue();
        $queue->setAdapter($serviceLocator->get('tools.service.queue.adapter.sqs'));

        return $queue;
    }
}