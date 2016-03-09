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

use Zend\ServiceManager\ServiceLocatorAwareInterface;
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
class Sns implements AdapterInterface, ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * @return \Aws\Sns\SnsClient
     */
    protected function getClient()
    {
        /** @var \Aws\Sdk $aws */
        $aws = $this->getServiceLocator()->get(\Aws\Sdk::class);
        return $aws->createSns(['version' => '2010-03-31']);
    }

    public function publish($message, $topic)
    {
        return $this->getClient()->publish([
            'Message'  => $message,
            'TopicArn' => $topic,
        ]);
    }
}