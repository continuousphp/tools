<?php
/**
 * Encryption.php
 *
 * @date        14.08.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Encryption.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service;

/**
 * Encryption
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Encryption
{
    /** @var \Tools\Service\Encryption\Adapter\AdapterInterface $adapter */
    protected $adapter;

    /**
     * Set the adapter.
     *
     * @param \Tools\Service\Encryption\Adapter\AdapterInterface $adapter The adapter.
     * @return $this Provides a fluent interface.
     */
    public function setAdapter(\Tools\Service\Encryption\Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Return the adapter.
     *
     * @return \Tools\Service\Encryption\Adapter\AdapterInterface The adapter.
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    public function encrypt($key, $original)
    {
        return $this->getAdapter()->encrypt($key, $original);
    }

    public function decrypt($encrypted)
    {
        return $this->getAdapter()->decrypt($encrypted);
    }
}