<?php

namespace Tools\Factory\Service\Queue\Adapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Sqs implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $queueAdapterSqs = new \Tools\Service\Queue\Adapter\Sqs();
        $queueAdapterSqs->setServiceLocator($serviceLocator);

        return $queueAdapterSqs;
    }
}