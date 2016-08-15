<?php

namespace Tools\Factory\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Encryption implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $encryption = new \Tools\Service\Encryption();
        $encryption->setAdapter($serviceLocator->get('tools.service.encryption.adapter.sqs'));

        return $encryption;
    }
}