<?php
/**
 * AwsConfig.php
 *
 * @date        26.03.2017
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        Encryption.php
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 */

namespace Tools\Service;

/**
 * AwsConfig
 *
 * @package     Tools  
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @copyright   Copyright (c) ContinuousPHP - All rights reserved
 */
class AwsConfig
{
    /** @var string */
    protected $awsRegion;

    /** @var string */
    protected $awsKey;

    /** @var string */
    protected $awsSecret;

    /**
     * Set the AWS region.
     *
     * @param string $region
     * @return $this
     */
    public function setAwsRegion($region)
    {
        $this->awsRegion = $region;
        return $this;
    }

    /**
     * Get the AWS region.
     *
     * @return string
     */
    public function getAwsRegion()
    {
        return $this->awsRegion;
    }

    /**
     * Set the AWS key.
     *
     * @param string $key
     * @return $this
     */
    public function setAwsKey($key)
    {
        $this->awsKey = $key;
        return $this;
    }

    /**
     * Get the AWS key.
     *
     * @return string
     */
    public function getAwsKey()
    {
        return $this->awsKey;
    }

    /**
     * Set the AWS secret.
     *
     * @param string $secret
     * @return $this
     */
    public function setAwsSecret($secret)
    {
        $this->awsSecret = $secret;
        return $this;
    }

    /**
     * Get the AWS secret.
     *
     * @return string
     */
    public function getAwsSecret()
    {
        return $this->awsSecret;
    }

    /**
     * @return array The AWS config as expected by the SDK.
     */
    public function toArray()
    {
       $configArray = [];

       if ($this->getAwsRegion()) {
           $configArray['region'] = $this->getAwsRegion();
       }

       if ($this->getAwsKey() && $this->getAwsSecret()) {
           $configArray['credentials'] =
               [
                   'key'    => $this->getAwsKey(),
                   'secret' => $this->getAwsSecret()
               ];
       }

       return $configArray;
    }
}