<?php
/**
 * ConsoleAwareInterface.php
 *
 * @date        10.03.2016
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @file        ConsoleAwareInterface.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Tools\Service;

use Zend\Console\Adapter\AdapterInterface as Console;


/**
 * ConsoleAwareTrait
 *
 * @package     Tools
 * @subpackage  Service
 * @author      Pascal Paulis <pascal.paulis@continuousphp.com>
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
trait ConsoleAwareTrait
{
    /** @var  Console */
    protected $console;

    /** @var  bool */
    protected $verbose;

    /**
     * Get the console adapter
     *
     * @return Console
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * Set the console adapter
     *
     * @param Console $console
     *
     * @return self
     */
    public function setConsole(Console $console)
    {
        $this->console = $console;

        return $this;
    }

    /**
     * Verbose accessor
     *
     * @param null|bool $flag
     *
     * @return self|bool
     */
    public function verbose($flag = null)
    {
        if (is_null($flag)) {
            return $this->verbose;
        } else {
            $this->verbose = (bool)$flag;
            return $this;
        }
    }
}
 