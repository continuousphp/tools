<?php

namespace Tools\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Alerting implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $alerting = new \Tools\Service\Alerting();
        $alerting->setAdapter($serviceLocator->get('tools.service.alerting.adapter.sns'));

        return $alerting;
    }
}