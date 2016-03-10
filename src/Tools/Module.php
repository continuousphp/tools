<?php
/**
 * Module.php
 *
 * @date        09.03.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Module.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools;

use Zend\Config\Config;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * 
 * @package     Tools
 * @subpackage  Module
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return
        [
            'Zend\Loader\StandardAutoloader' =>
            [
                'namespaces' =>
                [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return Config
     */
    public function getConfig()
    {
        $config = new Config(require __DIR__ . '/../../config/common.php', true);

        return $config;
    }

}