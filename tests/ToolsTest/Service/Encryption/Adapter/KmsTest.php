<?php
/**
 * KmsTest.php
 *
 * @date        16.08.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        KmsTest.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace ToolsTest\Service\Encryption\Adapter;

use Zend\ServiceManager\ServiceManager;

/**
 * Class KmsTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class KmsTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Tools\Service\Encryption\Adapter\Kms */
    protected $instance;

    /** @var \Zend\ServiceManager\ServiceManager */
    protected $serviceManager;

    public function setUp()
    {
        $this->instance = new \Tools\Service\Encryption\Adapter\Kms();

        $this->serviceManager = new ServiceManager();
        $this->instance->setServiceLocator($this->serviceManager);

        // Aws Mock
        $awsMock = $this->getMock('\Aws\Common\Aws');
        $this->serviceManager->setService('aws', $awsMock);

        // ZF Config Mock
        $config =
            [
                'version' => '2014-11-01',
                'region'  => 'us-east-1',
            ];
        $this->serviceManager->setService('config', $config);
    }

    public function testEncrypt()
    {
        $toEncrypt = 'azerty1234';
        $keyId     = 'my-key';

        $kmsMock = $this->getMockBuilder('\Aws\Kms\KmsClient')
            ->setMethods(['encrypt'])
            ->disableOriginalConstructor()
            ->getMock();

        $result = $this->getMock('\Aws\Result');
        $result
            ->expects($this->once())
            ->method('get')
            ->with('CiphertextBlob')
            ->will($this->returnValue('encrypted'));

        $kmsMock
            ->expects($this->any())
            ->method('encrypt')
            ->with([
                'KeyId'     => $keyId,
                'Plaintext' => $toEncrypt,
            ])
            ->will($this->returnValue($result));

        $awsMock = $this->getMock('Aws\Sdk', ['createKms']);
        $awsMock
            ->expects($this->once())
            ->method('createKms')
            ->will($this->returnValue($kmsMock));
        $this->serviceManager->setService('Aws\Sdk', $awsMock);

        $this->assertEquals(base64_encode('encrypted'), $this->instance->encrypt($keyId, $toEncrypt));
    }

    public function testDecrypt()
    {
        $toDecrypt = 'ZW5jcnlwdGVk';

        $kmsMock = $this->getMockBuilder('\Aws\Kms\KmsClient')
            ->setMethods(['decrypt'])
            ->disableOriginalConstructor()
            ->getMock();

        $result = $this->getMock('\Aws\Result');
        $result
            ->expects($this->once())
            ->method('get')
            ->with('Plaintext')
            ->will($this->returnValue('azerty1234'));

        $kmsMock
            ->expects($this->any())
            ->method('decrypt')
            ->with([
                'CiphertextBlob' => base64_decode($toDecrypt),
            ])
            ->will($this->returnValue($result));

        $awsMock = $this->getMock('Aws\Sdk', ['createKms']);
        $awsMock
            ->expects($this->once())
            ->method('createKms')
            ->will($this->returnValue($kmsMock));
        $this->serviceManager->setService('Aws\Sdk', $awsMock);

        $this->assertEquals('azerty1234', $this->instance->decrypt($toDecrypt));
    }
}