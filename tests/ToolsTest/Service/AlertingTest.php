<?php
/**
 * AlertingTest.php
 *
 * @date        09.03.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        AlertingTest.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace ToolsTest\Service;

/**
 * Class AlertingTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class AlertingTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Tools\Service\Alerting */
    protected $instance;

    protected $adapterMock;

    public function setUp()
    {
        $this->instance = new \Tools\Service\Alerting();

        $this->adapterMock = $this->getMock('\Tools\Service\Alerting\Adapter\AdapterInterface');
        $this->instance->setAdapter($this->adapterMock);
    }

    public function testPublish()
    {
        $message = 'test message';
        $topic   = 'test topic';
        $result  = 'result';

        $this->adapterMock
            ->expects($this->once())
            ->method('publish')
            ->with($message, $topic)
            ->will($this->returnValue($result));

        $response = $this->instance->publish($message, $topic);

        $this->assertEquals($result, $response);
    }
}