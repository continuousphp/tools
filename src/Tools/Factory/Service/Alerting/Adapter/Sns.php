<?php

namespace Tools\Factory\Service\Alerting\Adapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Sns implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $alertingAdapterSns = new \Tools\Service\Alerting\Adapter\Sns();
        $alertingAdapterSns->setServiceLocator($serviceLocator);

        return $alertingAdapterSns;
    }
}