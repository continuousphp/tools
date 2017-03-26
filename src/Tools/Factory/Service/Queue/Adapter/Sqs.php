<?php

namespace Tools\Factory\Service\Queue\Adapter;

use Tools\Service\AwsConfig;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Sqs implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $queueAdapterSqs = new \Tools\Service\Queue\Adapter\Sqs();
        $queueAdapterSqs->setServiceLocator($serviceLocator);

        // Setting the optional AWS config
        if ($serviceLocator->has('config')) {
            $config = $serviceLocator->get('config');

            if (array_key_exists('aws', $config)) {
                /** @var AwsConfig $awsConfigObject */
                $awsConfigObject = $serviceLocator->get('tools.service.aws-config');

                if (array_key_exists('region', $config['aws'])) {
                    $awsConfigObject->setAwsRegion($config['aws']['region']);
                }

                if (array_key_exists('credentials', $config['aws']) &&
                    array_key_exists('key', $config['aws']['credentials']) &&
                    array_key_exists('secret', $config['aws']['credentials']))
                {
                    $awsConfigObject
                        ->setAwsKey($config['aws']['credentials']['key'])
                        ->setAwsSecret($config['aws']['credentials']['secret']);
                }

                $queueAdapterSqs->setAwsConfig($awsConfigObject);
            }
        }

        return $queueAdapterSqs;
    }
}