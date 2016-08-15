<?php
/**
 * Kms.php
 *
 * @date        14.08.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Kms.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service\Encryption\Adapter;

use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Kms
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Kms implements AdapterInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * @return \Aws\Kms\KmsClient
     */
    protected function getClient()
    {
        /** @var \Aws\Sdk $aws */
        $aws = $this->getServiceLocator()->get(\Aws\Sdk::class);
        return $aws->createKms(['version' => '2014-11-01']);
    }

    public function encrypt($key, $original)
    {
    }

    public function decrypt($encrypted)
    {
    }
}