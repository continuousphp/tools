<?php
/**
 * AwsConfigAwareInterface.php
 *
 * @date        26.03.2017
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        AwsConfigAwareInterface.php
 */

namespace Tools\Service;

/**
 * Class AwsConfigAwareInterface
 * 
 * @package     Tools
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 */
interface AwsConfigAwareInterface
{
    /**
     * Get the AWS config.
     *
     * @return AwsConfig
     */
    public function getAwsConfig();

    /**
     * Set the AWS config.
     *
     * @param AwsConfig $awsConfig
     * @return $this
     */
    public function setAwsConfig(AwsConfig $awsConfig);
}
 