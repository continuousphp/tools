<?php
/**
 * Sqs.php
 *
 * @date        05.02.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Sqs.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service\Queue\Adapter;

use Tools\Service\AwsConfigAwareInterface;
use Tools\Service\AwsConfigAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Sqs
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Sqs implements AdapterInterface, AwsConfigAwareInterface
{
    use ServiceLocatorAwareTrait;
    use AwsConfigAwareTrait;

    /**
     * @return \Aws\Sqs\SqsClient
     */
    protected function getClient()
    {
        $parameters = ['version' => '2012-11-05'];

        if ($this->getAwsConfig()) {
            $parameters = array_merge($parameters, $this->getAwsConfig()->toArray());
        }

        /** @var \Aws\Sdk $aws */
        $aws = $this->getServiceLocator()->get(\Aws\Sdk::class);
        return $aws->createSqs($parameters);
    }

    public function sendMessage($queueUrl, $messageBody)
    {
        $this->getClient()->sendMessage([
            'QueueUrl'    => $queueUrl,
            'MessageBody' => $messageBody,
        ]);
    }

    public function receiveMessage($queueUrl)
    {
        $result = $this->getClient()->receiveMessage(['QueueUrl' => $queueUrl]);

        if (!empty($result['Messages'])) {
            // By default, only one message will be returned
            foreach ($result['Messages'] as $message) {
                return $message;
            }
        }

        return null;
    }

    public function deleteMessage($queueUrl, $receiptHandle)
    {
        $this->getClient()->deleteMessage([
            'QueueUrl'      => $queueUrl,
            'ReceiptHandle' => $receiptHandle
        ]);
    }
}