<?php
/**
 * Initializer.php
 *
 * @date        10.03.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Initializer.php
 * @copyright   Copyright (c) ContinuousPhp - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service;

use Zend\Console\Console;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Initializer
 *
 * @package     Tools
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPhp - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Initializer implements InitializerInterface
{
    /**
     * @param                         $instance
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof ConsoleAwareInterface) {
            $console = $serviceLocator->get('console');

            if ($console instanceof Console || $console instanceof \Zend\Console\Adapter\AdapterInterface) {
                $instance->setConsole($console);
            }
        }

        return $instance;
    }

}