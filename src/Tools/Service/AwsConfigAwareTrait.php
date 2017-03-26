<?php
/**
 * AwsConfigAwareTrait.php
 *
 * @date        26.03.2017
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        AwsConfigAwareTrait.php
 */

namespace Tools\Service;

/**
 * AwsConfigAwareTrait
 *
 * @package     Tools
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 */
trait AwsConfigAwareTrait
{
    protected $awsConfig;

    /**
     * Get the AWS config.
     *
     * @return AwsConfig
     */
    public function getAwsConfig()
    {
        return $this->awsConfig;
    }

    /**
     * Set the AWS config.
     *
     * @param AwsConfig $awsConfig
     * @return $this
     */
    public function setAwsConfig(AwsConfig $awsConfig)
    {
        $this->awsConfig = $awsConfig;
        return $this;
    }
}
 