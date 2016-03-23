<?php
/**
 * Alerting.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Alerting.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service;

/**
 * Alerting
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Alerting
{
    /** @var \Tools\Service\Alerting\Adapter\AdapterInterface $adapter */
    protected $adapter;

    /**
     * Set the adapter.
     *
     * @param \Tools\Service\Alerting\Adapter\AdapterInterface $adapter The adapter.
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(\Tools\Service\Alerting\Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Return the adapter.
     *
     * @return \Tools\Service\Alerting\Adapter\AdapterInterface The adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Publish the given message to the given topic.
     *
     * @param string $message
     * @param string $topic
     * @param string $subject
     * @return mixed
     */
    public function publish($message, $topic, $subject = null)
    {
        return $this->getAdapter()->publish($message, $topic, $subject);
    }
}