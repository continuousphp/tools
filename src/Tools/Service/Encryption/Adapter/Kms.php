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
        $config = $this->getServiceLocator()->get('config');

        $kmsConfig =
            [
                'version' => '2014-11-01'
            ];

        if (array_key_exists('aws', $config)) {
            $kmsConfig = array_merge($kmsConfig, $config['aws']);
        }

        /** @var \Aws\Sdk $aws */
        $aws = $this->getServiceLocator()->get(\Aws\Sdk::class);
        return $aws->createKms($kmsConfig);
    }

    public function encrypt($key, $original)
    {
        $result = $this->getClient()->encrypt([
            'KeyId'     => $key,
            'Plaintext' => $original
        ]);

        return base64_encode($result->get('CiphertextBlob'));
    }

    public function decrypt($encrypted)
    {
        $result = $this->getClient()->decrypt([
            'CiphertextBlob' => base64_decode($encrypted),
        ]);

        return $result->get('Plaintext');
    }
}