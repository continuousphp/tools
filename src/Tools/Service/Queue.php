<?php
/**
 * Queue.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Queue.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service;

use Zend\Console\ColorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Queue
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Queue implements ServiceLocatorAwareInterface, ConsoleAwareInterface
{
    use ServiceLocatorAwareTrait;
    use ConsoleAwareTrait;

    /** @var \Tools\Service\Queue\Adapter\AdapterInterface $adapter */
    protected $adapter;

    /**
     * Set the adapter.
     *
     * @param \Tools\Service\Queue\Adapter\AdapterInterface $adapter The adapter.
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(\Tools\Service\Queue\Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Return the adapter.
     *
     * @return \Tools\Service\Queue\Adapter\AdapterInterface The adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    public function sendMessage($queueUrl, $messageBody)
    {
        // Check first if we are running in a console
        if ($this->getConsole()) {
            $this->getConsole()->writeLine(date_create()->format('[c] ') . "Sending a message on $queueUrl ...", ColorInterface::LIGHT_GREEN);
        }

        return $this->getAdapter()->sendMessage($queueUrl, $messageBody);
    }

    public function receiveMessage($queueUrl)
    {
        // Check first if we are running in a console
        if ($this->getConsole()) {
            $this->getConsole()->writeLine(date_create()->format('[c] ') . "Checking queue for messages on $queueUrl ...", ColorInterface::LIGHT_GREEN);
        }

        return $this->getAdapter()->receiveMessage($queueUrl);
    }

    public function deleteMessage($queueUrl, $receiptHandle)
    {
        // Check first if we are running in a console
        if ($this->getConsole()) {
            $this->getConsole()->writeLine(date_create()->format('[c] ') . "Deleting message $receiptHandle on queue $queueUrl ...", ColorInterface::LIGHT_GREEN);
        }

        return $this->getAdapter()->deleteMessage($queueUrl, $receiptHandle);
    }
}