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
class Sqs implements AdapterInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * @return \Aws\Sqs\SqsClient
     */
    protected function getClient()
    {
        $config = $this->getServiceLocator()->get('config');

        $sqsConfig =
            [
                'version' => '2012-11-05'
            ];

        if (array_key_exists('aws', $config)) {
            $sqsConfig = array_merge($sqsConfig, $config['aws']);
        }

        /** @var \Aws\Sdk $aws */
        $aws = $this->getServiceLocator()->get(\Aws\Sdk::class);
        return $aws->createSqs($sqsConfig);
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