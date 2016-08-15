<?php

namespace Tools\Factory\Service\Alerting\Adapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Kms implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $alertingAdapterKms = new \Tools\Service\Alerting\Adapter\Kms();
        $alertingAdapterKms->setServiceLocator($serviceLocator);

        return $alertingAdapterKms;
    }
}