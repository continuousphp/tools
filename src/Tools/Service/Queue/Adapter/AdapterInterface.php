<?php
/**
 * AdapterInterface.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        AdapterInterface.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service\Queue\Adapter;

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
    /**
     * @param $queueUrl
     * @param $messageBody
     * @return mixed
     */
    public function sendMessage($queueUrl, $messageBody);

    /**
     * @param $queueUrl
     * @return mixed
     */
    public function receiveMessage($queueUrl);

    /**
     * @param $queueUrl
     * @param $receiptHandle
     * @return mixed
     */
    public function deleteMessage($queueUrl, $receiptHandle);
}