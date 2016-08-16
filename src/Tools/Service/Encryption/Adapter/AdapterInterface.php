<?php
/**
 * AdapterInterface.php
 *
 * @date        15.08.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        AdapterInterface.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service\Encryption\Adapter;

/**
 * AdapterInterface
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
interface AdapterInterface
{
    public function encrypt($key, $original);

    public function decrypt($encrypted);
}