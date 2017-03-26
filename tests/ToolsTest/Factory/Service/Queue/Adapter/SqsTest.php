<?php
/**
 * SqsTest.php
 *
 * @date        26.03.2017
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        SqsTest.php
 */

namespace ToolsTest\Factory\Service\Queue\Adapter;

use Zend\ServiceManager\ServiceManager;

/**
 * Class SqsTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 */
class SqsTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Tools\Factory\Service\Queue\Adapter\Sqs */
    protected $instance;

    public function setUp()
    {
        $this->instance = new \Tools\Factory\Service\Queue\Adapter\Sqs();
    }

    public function testCreateService_NoAwsConfig()
    {
        $serviceManager = new ServiceManager();

        $this->instance->createService($serviceManager);

        $adapterSqs = $this->instance->createService($serviceManager);

        $this->assertInstanceOf('\Tools\Service\Queue\Adapter\Sqs', $adapterSqs);
        $this->assertNull($adapterSqs->getAwsConfig());
    }

    public function testCreateService_AwsConfigWithOnlyRegion()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('config', [
            'aws' => ['region' => 'eu-west-1']
        ]);
        $serviceManager->setInvokableClass('tools.service.aws-config', '\Tools\Service\AwsConfig', false);

        $this->instance->createService($serviceManager);

        $adapterSqs = $this->instance->createService($serviceManager);

        $this->assertInstanceOf('\Tools\Service\Queue\Adapter\Sqs', $adapterSqs);
        $this->assertEquals(
            [
                'region' => 'eu-west-1'
            ],
            $adapterSqs->getAwsConfig()->toArray()
        );
    }

    public function testCreateService_AwsConfigWithCredentials()
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('config', [
            'aws' =>
                [
                    'region'      => 'eu-west-1',
                    'credentials' =>
                        [
                            'key'    => 'AZERTY1234',
                            'secret' => 'azerty1234!'
                        ]
                ]
        ]);
        $serviceManager->setInvokableClass('tools.service.aws-config', '\Tools\Service\AwsConfig', false);

        $this->instance->createService($serviceManager);

        $adapterSqs = $this->instance->createService($serviceManager);

        $this->assertInstanceOf('\Tools\Service\Queue\Adapter\Sqs', $adapterSqs);
        $this->assertEquals(
            [
                'region'      => 'eu-west-1',
                'credentials' =>
                    [
                        'key'    => 'AZERTY1234',
                        'secret' => 'azerty1234!'
                    ]
            ],
            $adapterSqs->getAwsConfig()->toArray()
        );
    }
}