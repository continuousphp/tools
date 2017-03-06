<?php
/**
 * SnsTest.php
 *
 * @date        09.03.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        SnsTest.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace ToolsTest\Service\Alerting\Adapter;

use Zend\ServiceManager\ServiceManager;

/**
 * Class SnsTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class SnsTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Tools\Service\Alerting\Adapter\Sns */
    protected $instance;

    /** @var \Zend\ServiceManager\ServiceManager */
    protected $serviceManager;

    public function setUp()
    {
        $this->instance = new \Tools\Service\Alerting\Adapter\Sns();

        $this->serviceManager = new ServiceManager();
        $this->instance->setServiceLocator($this->serviceManager);

        // Aws Mock
        $awsMock = $this->getMock('\Aws\Common\Aws');
        $this->serviceManager->setService('aws', $awsMock);

        // ZF Config Mock
        $config =
            [
                'version' => '2010-03-31',
                'region'  => 'us-east-1',
            ];
        $this->serviceManager->setService('config', $config);
    }

    public function testPublish()
    {
        $message = 'test message';
        $topic   = 'test topic';
        $subject = 'test subject';

        $snsMock = $this->getMockBuilder('\Aws\Sns\SnsClient')
            ->setMethods(['publish'])
            ->disableOriginalConstructor()
            ->getMock();

        $snsMock
            ->expects($this->any())
            ->method('publish')
            ->with([
                'Message'  => $message,
                'TopicArn' => $topic,
                'Subject'  => $subject
            ]);

        $awsMock = $this->getMock('Aws\Sdk', ['createSns']);
        $awsMock
            ->expects($this->once())
            ->method('createSns')
            ->will($this->returnValue($snsMock));
        $this->serviceManager->setService('Aws\Sdk', $awsMock);

        $this->instance->publish($message, $topic, $subject);
    }
}