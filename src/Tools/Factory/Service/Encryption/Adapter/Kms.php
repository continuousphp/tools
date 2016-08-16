<?php

namespace Tools\Factory\Service\Encryption\Adapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Kms implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $encryptionAdapterKms = new \Tools\Service\Encryption\Adapter\Kms();
        $encryptionAdapterKms->setServiceLocator($serviceLocator);

        return $encryptionAdapterKms;
    }
}