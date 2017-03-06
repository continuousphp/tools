<?php
/**
 * Sns.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Sns.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service\Alerting\Adapter;

use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Sns
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Sns implements AdapterInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * @return \Aws\Sns\SnsClient
     */
    protected function getClient()
    {
        $config = $this->getServiceLocator()->get('config');

        $snsConfig =
            [
                'version' => '2010-03-31'
            ];

        if (array_key_exists('aws', $config)) {
            $snsConfig = array_merge($snsConfig, $config['aws']);
        }

        /** @var \Aws\Sdk $aws */
        $aws = $this->getServiceLocator()->get(\Aws\Sdk::class);
        return $aws->createSns($snsConfig);
    }

    public function publish($message, $topic, $subject = null)
    {
        return $this->getClient()->publish([
            'Message'  => $message,
            'TopicArn' => $topic,
            'Subject'  => $subject
        ]);
    }
}