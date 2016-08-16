<?php
/**
 * service.php
 *
 * @date        5/11/13
 * @author      fde
 * @file        service.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

return
    [
        'service_manager' =>
            [
                'invokables' =>
                    [
                    ],
                'abstract_factories' =>
                    [
                    ],
                'factories' =>
                    [
                        'tools.service.alerting'               => '\Tools\Factory\Service\Alerting',
                        'tools.service.alerting.adapter.sns'   => '\Tools\Factory\Service\Alerting\Adapter\Sns',
                        'tools.service.queue'                  => '\Tools\Factory\Service\Queue',
                        'tools.service.queue.adapter.sqs'      => '\Tools\Factory\Service\Queue\Adapter\Sqs',
                        'tools.service.encryption'             => '\Tools\Factory\Service\Encryption',
                        'tools.service.encryption.adapter.kms' => '\Tools\Factory\Service\Encryption\Adapter\Kms',
                    ],
                'initializers' =>
                    [
                        '\Tools\Service\Initializer'
                    ],
                'shared' =>
                    [
                    ],
            ],
        'hydrators' =>
            [
                'invokables' =>
                    [
                    ],
                'aliases' =>
                    [
                    ]
            ]
    ];