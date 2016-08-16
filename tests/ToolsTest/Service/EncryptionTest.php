<?php
/**
 * EncryptionTest.php
 *
 * @date        16.08.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        EncryptionTest.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace ToolsTest\Service;

/**
 * Class EncryptionTest
 * 
 * @package     ToolsTest
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class EncryptionTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \Tools\Service\Encryption */
    protected $instance;

    public function setUp()
    {
        $this->instance = new \Tools\Service\Encryption();

        $adapterMock = $this->getMock('\Tools\Service\Encryption\Adapter\AdapterInterface');
        $this->instance->setAdapter($adapterMock);
    }

    public function testEncrypt()
    {
        $toEncrypt = 'azerty1234';
        $keyId     = 'my-key';

        $this->instance->getAdapter()
            ->expects($this->once())
            ->method('encrypt')
            ->with($keyId, $toEncrypt);

        $this->instance->encrypt($keyId, $toEncrypt);
    }

    public function testDecrypt()
    {
        $toDecrypt = 'azerty1234';

        $this->instance->getAdapter()
            ->expects($this->once())
            ->method('decrypt')
            ->with($toDecrypt);

        $this->instance->decrypt($toDecrypt);
    }
}