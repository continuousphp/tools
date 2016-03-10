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
                        'tools.service.alerting.adapter.sns' => '\Tools\Service\Alerting\Adapter\Sns'
                    ],
                'abstract_factories' =>
                    [
                    ],
                'factories' =>
                    [
                        'tools.service.alerting' => '\Tools\Factory\Alerting'
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