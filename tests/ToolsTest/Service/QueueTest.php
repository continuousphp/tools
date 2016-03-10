<?php
/**
 * QueueTest.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        QueueTest.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace ToolsTest\Service;

/**
 * Class QueueTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class QueueTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Tools\Service\Queue */
    protected $instance;

    public function setUp()
    {
        $this->instance = new \Tools\Service\Queue();

        $adapterMock = $this->getMock('\Tools\Service\Queue\Adapter\AdapterInterface');
        $this->instance->setAdapter($adapterMock);

        $console = $this->getMock('Zend\Console\Adapter\AdapterInterface');
        $this->instance->setConsole($console);
    }

    public function testSendMessage()
    {
        $queueUrl = 'my-queue';
        $messageBody = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $this->instance->getAdapter()
            ->expects($this->once())
            ->method('sendMessage')
            ->with($queueUrl, $messageBody);

        $this->instance->sendMessage($queueUrl, $messageBody);
    }

    public function testReceiveMessage()
    {
        $queueUrl = 'my-queue';
        $messageBody = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $this->instance->getAdapter()
            ->expects($this->once())
            ->method('receiveMessage')
            ->with($queueUrl)
            ->will($this->returnValue($messageBody));

        $response = $this->instance->receiveMessage($queueUrl);

        $this->assertEquals($messageBody, $response);
    }

    public function testDeleteMessage()
    {
        $queueUrl = 'my-queue';
        $receiptHandle = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $this->instance
            ->getAdapter()
            ->expects($this->once())
            ->method('deleteMessage')
            ->with($queueUrl, $receiptHandle);

        $this->instance->deleteMessage($queueUrl, $receiptHandle);
    }
}