<?php
/**
 * SqsTest.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        SqsTest.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace ToolsTest\Service\Queue\Adapter;

use Tools\Service\AwsConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * Class SqsTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class SqsTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Tools\Service\Queue\Adapter\Sqs */
    protected $instance;

    /** @var \Zend\ServiceManager\ServiceManager */
    protected $serviceManager;

    public function setUp()
    {
        $this->instance = new \Tools\Service\Queue\Adapter\Sqs();

        $awsConfig = new AwsConfig();
        $awsConfig
            ->setAwsRegion('eu-west-1')
            ->setAwsKey('AZERTY1234')
            ->setAwsSecret('azerty1234!');
        $this->instance->setAwsConfig($awsConfig);

        $awsMock = $this->getMock('\Aws\Common\Aws');

        $this->serviceManager = new ServiceManager();
        $this->serviceManager->setService('aws', $awsMock);
        $this->instance->setServiceLocator($this->serviceManager);
    }

    public function testSendMessage()
    {
        $queueUrl = 'my-queue';
        $messageBody = 'gzegezbzrbrzbzrgagaebrzbnrzb';

        $sqsMock = $this->getMockBuilder('\Aws\Sqs\SqsClient')
            ->setMethods(['sendMessage'])
            ->disableOriginalConstructor()
            ->getMock();

        $sqsMock
            ->expects($this->any())
            ->method('sendMessage')
            ->with([
                'QueueUrl'    => $queueUrl,
                'MessageBody' => $messageBody,
            ]);

        $awsMock = $this->getMock('Aws\Sdk', ['createSqs']);
        $awsMock->expects($this->once())
            ->method('createSqs')
            ->with([
                'version'     => '2012-11-05',
                'region'      => 'eu-west-1',
                'credentials' =>
                    [
                        'key'    => 'AZERTY1234',
                        'secret' => 'azerty1234!'
                    ]
            ])
            ->will($this->returnValue($sqsMock));
        $this->serviceManager->setService('Aws\Sdk', $awsMock);

        $this->instance->sendMessage($queueUrl, $messageBody);
    }

    public function testReceiveMessage()
    {
        $queueUrl = 'my-queue';
        $message = [
            'Body' => 'message-body',
            'ReceiptHandle' => 'receipt-handle'
        ];
        $response =
            [
                'Messages' =>
                    [
                        $message
                    ]
            ];

        $sqsMock = $this->getMockBuilder('\Aws\Sqs\SqsClient')
            ->setMethods(['receiveMessage'])
            ->disableOriginalConstructor()
            ->getMock();

        $sqsMock
            ->expects($this->once())
            ->method('receiveMessage')
            ->with(['QueueUrl' => $queueUrl])
            ->will($this->returnValue($response));

        $awsMock = $this->getMock('Aws\Sdk', ['createSqs']);
        $awsMock
            ->expects($this->any())
            ->method('createSqs')
            ->will($this->returnValue($sqsMock));
        $this->serviceManager->setService('Aws\Sdk', $awsMock);

        $response = $this->instance->receiveMessage($queueUrl);

        $this->assertEquals($message, $response);
    }

    public function testDeleteMessage()
    {
        $queueUrl = 'my-queue';
        $receiptHandle = 'receipt-handle';

        $sqsMock = $this
            ->getMockBuilder('\Aws\Sqs\SqsClient')
            ->setMethods(['deleteMessage'])
            ->disableOriginalConstructor()
            ->getMock();

        $sqsMock
            ->expects($this->once())
            ->method('deleteMessage')
            ->with(['QueueUrl' => $queueUrl, 'ReceiptHandle' => $receiptHandle]);

        $awsMock = $this->getMock('Aws\Sdk', ['createSqs']);
        $awsMock
            ->expects($this->any())
            ->method('createSqs')
            ->will($this->returnValue($sqsMock));
        $this->serviceManager->setService('Aws\Sdk', $awsMock);

        $this->instance->deleteMessage($queueUrl, $receiptHandle);
    }
}